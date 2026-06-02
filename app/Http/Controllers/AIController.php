<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    public function generateMessage(Request $request)
    {
        $status = $request->input('status');
        $eta = $request->input('eta');
        $distance = $request->input('distance');
        $itemCount = $request->input('itemCount', 1);
        $totalQuantity = $request->input('totalQuantity', 1);

        // Build a more detailed prompt for Ollama
        $prompt = "You are a friendly food delivery service AI assistant. Generate a short, enthusiastic delivery status message in Arabic (2-3 sentences max).

Order Details:
- Status: $status
- Estimated Delivery Time: $eta minutes
- Delivery Distance: $distance miles
- Number of Different Items: $itemCount
- Total Items Ordered: $totalQuantity

Important: 
- Write ONLY in Arabic
- Keep it friendly and encouraging
- Keep it SHORT (max 2-3 sentences)
- Do not include any other text or English words

Message:";

        try {
            $response = Http::timeout(10)->post('http://localhost:11434/api/generate', [
                'model' => 'phi3:mini',
                'prompt' => $prompt,
                'stream' => false,
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                $message = trim($response->json()['response'] ?? '');
                
                // Fallback if message is empty
                if (empty($message)) {
                    $message = "طلبك جاهز للتوصيل! الوقت المتوقع: $eta دقيقة.";
                }
                
                return response()->json([
                    'message' => $message,
                    'eta' => $eta,
                    'distance' => $distance
                ]);
            } else {
                throw new \Exception('Ollama API error');
            }
        } catch (\Exception $error) {
            // Fallback message if Ollama fails
            $fallbackMessage = "طلبك قيد التحضير! الوقت المتوقع: $eta دقيقة.";
            
            return response()->json([
                'message' => $fallbackMessage,
                'eta' => $eta,
                'distance' => $distance,
                'error' => $error->getMessage()
            ]);
        }
    }
}