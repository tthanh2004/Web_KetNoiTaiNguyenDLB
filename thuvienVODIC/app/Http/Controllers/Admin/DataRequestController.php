<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataRequest;

class DataRequestController extends Controller
{
    // Danh sách yêu cầu (Mới nhất lên đầu)
    public function index()
    {
        $requests = DataRequest::with('processor') // Load thông tin Admin xử lý
                               ->orderBy('created_at', 'desc')
                               ->paginate(20);
        return view('admin.requests.index', compact('requests'));
    }

    // Xử lý trạng thái (Chuyển từ New -> Processed)
    public function update(Request $request, $id)
    {
        $dataRequest = DataRequest::findOrFail($id);

        // Cập nhật trạng thái và ghi nhận Admin đang thao tác
        $dataRequest->update([
            'status' => 'processed',
            'processed_by_user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Đã đánh dấu xử lý xong yêu cầu này!');
    }
    
    // Admin có thể xóa yêu cầu rác/spam
    public function destroy($id)
    {
        DataRequest::findOrFail($id)->delete();
        return back()->with('success', 'Đã xóa yêu cầu!');
    }
}