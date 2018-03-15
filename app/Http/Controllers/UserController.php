<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;

class UserController extends Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->User = new User;
	}

    public function show()
    {
        $result = $this->User->get_all_data();

        echo json_encode($result);
    }

    public function search(Request $request)
    {
        $result = $this->User->get_search($request->keyword);

        echo json_encode($result);
    }

    public function add(Request $request)
    {
        $ip = $request->ip();
        $result = $this->User->add($request->data, $ip);

        $status = '';
        $status = $result ? 'OK' : 'FAIL';

        echo json_encode($status);
    }

    public function delete(Request $request)
    {
        $result = $this->User->deleteItem($request->id);

        echo json_encode($result);
    }
}