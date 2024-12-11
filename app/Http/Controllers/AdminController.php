<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Number;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class AdminController extends Controller
{
    public function product() {
        if (Auth::id()) {
            if (Auth::user()->usertype == '1') {
                return view('admin.product');
            }
            else {
                return redirect()->back();
            }
        }
        else {
            return redirect('login');
        }
    }

    public function uploadproduct(Request $request) {
        $data = new Product;

        $image = $request->file;
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->file->move('productimage', $imagename);
        $data->image = $imagename;

        $imageFullPath = public_path('productimage/' . $imagename);
        $category = $this->classifyImage($imageFullPath);

        $data->title = $request->title;
        $idrprice =  Number::format($request->price, locale: 'id');
        $data->price = $idrprice;
        $data->description = $category;
        $data->quantity = $request->quantity;

        $data->save();

        return redirect()->back()->with('message', 'Product added successfully');
    }

    private function classifyImage($imagePath) {
        // Roboflow API details
        $apiKey = 'XEh2P8fzNTuQHga4HBVv';
        $modelEndpoint = 'https://detect.roboflow.com/tokoonline/2'; // e.g., 'https://detect.roboflow.com/your-model/1';

        $client = new \GuzzleHttp\Client();

        $url = $modelEndpoint . '?api_key=' . $apiKey . '&format=json';

        // Send the image file to Roboflow
        $response = $client->request('POST', $url, [
            'multipart' => [
                [
                    'name'     => 'file',
                    'contents' => fopen($imagePath, 'r')
                ]
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        // Check if predictions are available
        if (!empty($data['predictions'])) {
            // Initialize an array to hold detected classes
            $detectedClasses = [];

            // Loop through all detected objects
            foreach ($data['predictions'] as $prediction) {
                // Get the class label
                $class = $prediction['class'];

                // Add the class to the array if not already added
                if (!in_array($class, $detectedClasses)) {
                    $detectedClasses[] = $class;
                }
            }

            // Return the classes as a comma-separated string
            $categories = implode(', ', $detectedClasses);
        } else {
            $categories = 'Uncategorized';
        }

        return $categories;
    }

    public function showproduct() {
        $data = Product::all();
        return view('admin.showproduct', compact('data'));
    }

    public function deleteproduct($id) {
        $data = Product::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Product deleted');
    }

    public function updateview($id) {
        $data = Product::find($id);
        $unformattedPrice = str_replace(['.', ','], '', $data->price);
        $data->price = $unformattedPrice;
        return view('admin.updateview', compact('data'));
    }

    public function updateproduct(Request $request, $id) {
        $data = Product::find($id);
        $image = $request->file;

        if ($image) {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->file->move('productimage', $imagename);
            $data->image = $imagename;
        }

        $data->title = $request->title;
        $idrprice =  Number::format($request->price, locale: 'id');
        $data->price = $idrprice;
        $data->description = $request->desc;
        $data->quantity = $request->quantity;

        $data->save();

        return redirect()->back()->with('message', 'Product updated successfully');
    }

    public function showorder() {
        $order = Order::all();

        return view('admin.showorder', compact('order'));
    }

    public function updatestatus($id) {
        $order = Order::find($id);

        $order->status = 'Delivered';
        $order->save();

        return redirect()->back();
    }
}