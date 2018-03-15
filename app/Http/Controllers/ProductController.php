<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;

class ProductController extends Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->Product = new Product;
	}

	public function show()
    {
        $result = $this->Product->get_all_data();

        echo json_encode($result);
    }

    public function search(Request $request)
    {
        $result = $this->Product->get_search($request->keyword);

        echo json_encode($result);
    }

    public function add(Request $request)
    {
        $result = $this->Product->add($request->data);

        $status = '';
        $status = $result ? 'OK' : 'FAIL';

        echo json_encode($status);
    }

    public function delete(Request $request)
    {
        $result = $this->Product->deleteItem($request->id);

        echo json_encode($result);
    }

}