<?php 
namespace App\Controller;
use App\Models\OrderModel;
class Order extends OrderController
{
    protected $order;
    public function __construct() {
        $this->order = new OrderModel();
    }
    public function index(): string
{
   $data = $this->order->findAll();
   return view('order' ,['data'=>$data]);
}
public function tambah(){
    return view('tambah_order');
}

public function add() {
    $param =$this->request->getPost();
    $this->order->insert($param);
    return redirect()->to(base_url('order'));
}
    
public function ubah() {
 return view('ubah_order');
}
public function update(){
    $param=$this->request->getPost();
    $this->order->insert($param);
    return redirect()->to(base_url('order'));

}
public function deleteI($id) {
    $this->order->delete($id);
    return redirect()->to(base_url('order'));
}
}