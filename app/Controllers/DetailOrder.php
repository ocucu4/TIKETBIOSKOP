<?php 
namespace App\Controller;

use App\Controllers\BaseController;
use App\Models\DetailOrderModel;

class DetailOrder extends BaseController
{
    protected $detailorder;
    public function __construct() {
        $this->detailorder = new DetailOrderModel();
    }
    public function index(): string
{
   $data = $this->detailorder->findAll();
   return view('detailorder' ,['data'=>$data]);
}
public function tambah(){
    return view('tambah_detailorder');
}

public function add() {
    $param =$this->request->getPost();
    $this->detailorder->insert($param);
    return redirect()->to(base_url('detailorder'));
}
    
public function ubah() {
 return view('ubah_detailorder');
}
public function update(){
    $param=$this->request->getPost();
    $this->detailorder->insert($param);
    return redirect()->to(base_url('detailorder'));

}
public function deleteI($id) {
    $this->detailorder->delete($id);
    return redirect()->to(base_url('detailorder'));
}
}