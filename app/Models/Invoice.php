<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    use HasFactory;
    public function AllInvoiceOnline(){
        $invoice = DB::select("SELECT * FROM donhang WHERE hinhthucdonhang = 'Ăn tại nhà'");
        return $invoice;
    }
    public function GetInvoiceByCustomer($id){
        $invoice = DB::select("SELECT * FROM donhang WHERE makhachhang=".$id);
        return $invoice;
    }
    public function GetInvoiceByID($id){
        $invoice = DB::select("SELECT * FROM donhang WHERE madonhang=".$id);
        return $invoice;
    }
    public function CheckInvoiceOnline(){
        $invoice = DB::select("SELECT * FROM donhang WHERE hinhthucdonhang = 'Ăn tại nhà' AND trangthai='Đang chờ duyệt'");
        return $invoice;
    }
    public function AcceptInvoiceOnline($id, $employee){
        $invoice = DB::table('donhang')
        ->where('madonhang', $id)
        ->update([
            'trangthai' => "Đang nấu",
            'duyetdon' => $employee,
        ]);
        return $invoice;
    }
    public function CancelInvoiceOnline($id, $employee){
        $invoice = DB::table('donhang')
        ->where('madonhang', $id)
        ->update([
            'trangthai' => "Hủy đơn",
            'duyetdon' => $employee,
        ]);
        return $invoice;
    }
    public function CookInvoiceOnline(){
        $invoice = DB::select("SELECT * FROM donhang WHERE hinhthucdonhang = 'Ăn tại nhà' AND trangthai='Đang nấu'");
        return $invoice;
    }
    public function CookDoneInvoiceOnline($id, $employee){
        $invoice = DB::table('donhang')
        ->where('madonhang', $id)
        ->update([
            'trangthai' => "Đang vận chuyển",
            'naudon' => $employee,
        ]);
        return $invoice;
    }
    public function ShipInvoiceOnline(){
        $invoice = DB::select("SELECT * FROM donhang WHERE hinhthucdonhang = 'Ăn tại nhà' AND trangthai='Đang vận chuyển'");
        return $invoice;
    }
    public function ShipDoneInvoiceOnline($id, $employee){
        $invoice = DB::table('donhang')
        ->where('madonhang', $id)
        ->update([
            'trangthai' => "Hoàn thành",
            'vanchuyen' => $employee,
        ]);
        return $invoice;
    }
    public function AllInvoiceOffline(){
        $invoice = DB::select("SELECT * FROM donhang WHERE hinhthucdonhang = 'Ăn tại quán'");
        return $invoice;
    }
    public function DetailInvoice($id){
        $invoice = DB::select("SELECT madonhang, masanpham, tensanpham, dongia, SUM(soluong) as soluong FROM chitietdonhang WHERE madonhang=".$id." GROUP BY masanpham");
        return $invoice;
    }
    public function DetailInvoiceOffline($id){
        $invoice = DB::select("SELECT * FROM chitietdonhang WHERE madonhang=".$id);
        return $invoice;
    }
    public function SearchInvoiceOnline($idkh){
        $invoice = DB::select("SELECT * FROM donhang WHERE makhachhang=".$idkh." ORDER BY madonhang DESC LIMIT 1");
        return $invoice;
    }
    public function SearchInvoiceOffline($idb){
        $invoice = DB::select("SELECT * FROM donhang WHERE maban='".$idb."' ORDER BY madonhang DESC LIMIT 1");
        return $invoice;
    }
    public function AddInvoiceOnline($name, $phone, $address, $describe, $payment, $discount, $idkh){
        $invoice = DB::table('donhang')->insert([
            'tennguoinhan' => $name,
            'sdt' => $phone,
            'diachinhan' => $address,
            'ghichu' => $describe,
            'trangthai' => "Đang chờ duyệt",
            'hinhthucdonhang' => "Ăn tại nhà",
            'hinhthucthanhtoan' => $payment,
            'phantram' => $discount,
            'makhachhang' => $idkh
        ]);
        return $invoice;
    }
    public function AddInvoiceOnlineNoDesscribe($name, $phone, $address, $payment, $discount, $idkh){
        $invoice = DB::table('donhang')->insert([
            'tennguoinhan' => $name,
            'sdt' => $phone,
            'diachinhan' => $address,
            'trangthai' => "Đang chờ duyệt",
            'hinhthucdonhang' => "Ăn tại nhà",
            'hinhthucthanhtoan' => $payment,
            'phantram' => $discount,
            'makhachhang' => $idkh
        ]);
        return $invoice;
    }
    public function AddProductInvoice($iddh, $idsp, $name, $price, $number, $status){
        $invoice = DB::table('chitietdonhang')->insert([
            'madonhang' => $iddh,
            'masanpham' => $idsp,
            'tensanpham' => $name,
            'dongia' => $price,
            'soluong' => $number,
            'trangthai' => $status
        ]);
        return $invoice;
    }
    public function DeleteProductInvoice($idh, $idsp){
        $invoice  = DB::table('chitietdonhang')
                        ->where('madonhang', $idh)
                        ->where('masanpham', $idsp)
                        ->where('trangthai', "Đang nấu")
                        ->delete();
        return $invoice;
    }
    public function UpdateQuantity($idh, $idsp, $number){
        $invoice  = DB::table('chitietdonhang')
                        ->where('madonhang', $idh)
                        ->where('masanpham', $idsp)
                        ->where('trangthai', "Đang nấu")
                        ->update([
                            'soluong' => $number,
                        ]);
        return $invoice;
    }
    public function OpenInvoiceOffline( $table){
        $invoice = DB::table('donhang')->insert([
            'maban' => $table,
            'trangthai' => "Đang nấu",
            'hinhthucdonhang' => "Ăn tại quán",
            'phivanchuyen' => 0,
            'hinhthucthanhtoan' => ""
        ]);
        $table  = DB::table('ban')
                        ->where('maban', $table)
                        ->update(['trangthai' => "Đang sử dụng"]);
        return $invoice;
    }
    public function CloseInvoiceOffline($id, $table, $discount, $payment){
        $invoice = DB::table('donhang')
        ->where('madonhang', $id)
        ->update([
            'trangthai' => "Hoàn thành",
            'hinhthucdonhang' => "Ăn tại quán",
            'hinhthucthanhtoan' => $payment,
            'phantram' => $discount
        ]);
        $table  = DB::table('ban')
                ->where('maban', $table)
                ->update(['trangthai' => "Trống"]);
        return $invoice;
    }
    public function CookInvoiceOffline(){
        $invoice = DB::select("SELECT * FROM chitietdonhang INNER JOIN donhang WHERE chitietdonhang.madonhang = donhang.madonhang AND chitietdonhang.trangthai='Đang nấu'");
        return $invoice;
    }
    public function CookDoneInvoiceOffline($id, $sp){
        $invoice = DB::table('chitietdonhang')
        ->where('madonhang', $id)
        ->where('masanpham', $sp)
        ->where('trangthai', 'Đang nấu')
        ->update([
            'trangthai' => "Chờ lên món",
        ]);
        return $invoice;
    }
    public function DishupInvoiceOffline(){
        $invoice = DB::select("SELECT * FROM chitietdonhang INNER JOIN donhang WHERE chitietdonhang.madonhang = donhang.madonhang AND chitietdonhang.trangthai='Chờ lên món'");
        return $invoice;
    }
    public function DishupDoneInvoiceOffline($id, $sp){
        $invoice = DB::table('chitietdonhang')
        ->where('madonhang', $id)
        ->where('masanpham', $sp)
        ->where('trangthai', 'Chờ lên món')
        ->update([
            'trangthai' => "Hoàn thành",
        ]);
        return $invoice;
    }
    public function GetInvoiceByMonth($month, $year){
        $invoice = DB::select("SELECT SUM(dongia*soluong) AS doanhthu FROM chitietdonhang INNER JOIN donhang WHERE chitietdonhang.madonhang = donhang.madonhang AND MONTH(thoigian)=".$month." AND YEAR(thoigian)=".$year);
        return $invoice;
    }
    public function CountCheckInvoiceOnline($month, $year){
        $invoice = DB::select("SELECT duyetdon, COUNT(duyetdon) AS sodon FROM donhang WHERE MONTH(thoigian)=".$month." AND YEAR(thoigian)=".$year." GROUP BY duyetdon");
        return $invoice;
    }
    public function CountCookInvoiceOnline($month, $year){
        $invoice = DB::select("SELECT naudon, COUNT(naudon) AS sodon FROM donhang WHERE MONTH(thoigian)=".$month." AND YEAR(thoigian)=".$year." GROUP BY naudon");
        return $invoice;
    }
    public function CountShipInvoiceOnline($month, $year){
        $invoice = DB::select("SELECT vanchuyen, COUNT(vanchuyen) AS sodon FROM donhang WHERE MONTH(thoigian)=".$month." AND YEAR(thoigian)=".$year." GROUP BY vanchuyen");
        return $invoice;
    }
    public function DeleteByID($id){
        $category  = DB::table('donhang')
                        ->where('madonhang', $id)
                        ->delete();
        return $category;
    }
}
