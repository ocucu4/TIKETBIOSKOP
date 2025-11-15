<?php 
namespace App\Controller;
use App\Models\KursiModel;
class Kursi extends Kursi
{
    protected $kursi;
    public function __construct() {
        $this->kursi = new KursiModel();
    }
    public function index(): string
{
   $data = $this->kursi->findAll();
   return view('kursi' ,['data'=>$data]);
}
public function tambah(){
    return view('tambah/kursi');
}

public function add() {
    $param =$this->request->getPost();
    $this->kursi->insert($param);
    return redirect()->to(base_url('kursi'));
}
    
public function ubah() {
 return view('ubah_kursi');
}
public function update(){
    $param=$this->request->getPost();
    $this->kursi->insert($param);
    return redirect()->to(base_url('kursi'));

}
public function delete($id) {
    $this->kursi->delete($id);
    return redirect()->to(base_url('kursi'));
}
}