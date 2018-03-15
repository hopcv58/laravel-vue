<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
	protected $table = 'tbl_users';
	public $timestamps = false;

	public function get_all_data()
	{
		$data = DB::table($this->table)->where('deleted', 0)->paginate(3);

		return $data;
	}

	public function get_search($keyword)
	{
		$result = DB::table($this->table)->select('email', 'username')->where('email', 'like', '%'.$keyword.'%')->orWhere('username', 'like', '%'.$keyword.'%')->get();

		return $result;
	}

	public function add($data, $ip)
	{
		$id = DB::table($this->table)->insertGetId(
			[
				'username' => $data['username'],
				'phone' => $data['phone'],
				'email' => $data['email'],
				'ip_address' => $ip,
				'created_at' => date('Y-m-d H:i:s')
			]
		);

		return $id;
	}

	public function deleteItem($id)
	{
		$status = null;

		if($id) {

			$result = DB::table($this->table)->where('id', $id)->update(['deleted' => 1]);
			
			if($result) {
				$status = 'OK';
			}

		} else {

			$status = 'FAIL';

		}
		
		return $status;
	}
}