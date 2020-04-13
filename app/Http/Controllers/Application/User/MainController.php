<?php
namespace App\Http\Controllers\Application\User;
use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class MainController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $user=null;
    public function __construct()
    {
        if (!empty(User::userData())) {
            $this->user= User::userData();
        }
    }
}
