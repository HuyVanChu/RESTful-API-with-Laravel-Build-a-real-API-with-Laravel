<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Model\Transaction;
use App\Scopes\BuyerScopes;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buyer extends User
{
    protected $table = 'users';
    use SoftDeletes;
    protected $data=['deleted_at'];
    /**
     * https://laracasts.com/discuss/channels/laravel/parentboot?page=1&replyId=300997
     * 1. parent::boot     
     * Nó có nghĩa là lớp mà bạn thấy trong đó đang gọi phương thức khởi động cho lớp mà nó đang mở rộng.
     * Ví dụ: nếu bạn thấy nó trong mô hình Người dùng và nó đang mở rộng lớp Illuminate \ Database \ Eloquent \ Model, nó đang gọi phương thức khởi động cho lớp Model đó.
     * 2. addGlobalScope   Hãy tưởng tượng rằng bạn cần thêm một ràng buộc vào tất cả các truy vấn tới model. Nếu các bạn đã từng tìm hiểu qua soft delete trong laravel thì nó chính là một dạng global scope, mỗi khi truy vấn tới model sẽ chỉ lấy ra các bản ghi chưa được xóa mềm từ database. Viết một global scope sẽ giúp chúng ta thuận tiện hơn khi thêm ràng buộc tới từng truy vấn tới model.
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BuyerScopes);
    }
    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
