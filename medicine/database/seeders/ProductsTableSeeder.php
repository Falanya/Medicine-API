<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            array('name'=>'Cepmox-Clav 875mg/125mg', 'type_id'=>4, 'describe'=>'Không có', 'info'=>'Sản phẩm này chỉ bán khi có chỉ định của bác sĩ, mọi thông tin trên Website, App chỉ mang tính chất tham khảo. Vui lòng xác nhận bạn là dược sĩ, bác sĩ, nhân viên y tế có nhu cầu tìm hiểu về sản phẩm này', 
            'price'=>200000, 'img'=>'P25617_1N.jpg', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'),'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('name'=>'Men vi sinh hỗ trợ tiêu hóa BIFISANFO Plus', 'type_id'=>7, 'describe'=>'Mỗi gói 3g chứa: Fructose oligosaccharide (FOS) 500 mg; Cao Bạch phục linh 100 mg; Cao Mộc hoa trắng 100 mg; Immunepath-IP 100 mg; Curcumin phytosome 50 mg; 5-HTP 3 mg; Bifidobacterium lactis 108 CFU; Bifidobacterium longum 108 CFU; Lactobacillus acidophilus 108 CFU; Lacto bacillus caisei 108 CFU; Phụ liệu (Bột kem, Đường kính, Lactose) vừa đủ 3 g.', 'info'=>'Hỗ trợ giảm các triệu chứng của viêm đại tràng và hội chứng ruột kích thích như: đi ngoài nhiều lần trong ngày, đi ngoài phân lỏng, đau bụng. Hỗ trợ cân bằng hệ vi khuẩn có ích đường ruột, hỗ trợ tăng sức đề kháng và tăng cường sức khỏe hệ tiêu hóa.', 
            'price'=>200000, 'img'=>'P25862_1.jpg', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('name'=>'Dầu dưỡng giúp mờ sẹo & giảm rạn da Bio-Oil', 'type_id'=>1, 'describe'=>'Dầu Khoáng Chất, Trilsononaoin, Cetearyl Ethylhexanoat, Isopropyl Myristat, Vitamin A, Tinh Dầu Hạt Hướng Dương, Vitamin E, Tinh Dầu Cúc La Mã, Tinh Dầu Oải Hương, Tinh Dầu Lá Hương Thảo, Chiết Xuất Cúc Xu Xi, Tinh Dầu Đậu Tương Leo, BHT, Tinh Dầu Hoa Cúc, Chất Thơm, Alpha – Isomethyl Ionon, Amyl Cinnamal, Benzyl Salicylat, Citronellol, Coumarin, Eugenol, Farmesol, Geraniol, Hydroxycitronellal, Hydroxyisohexyl 3-Cyclohexen Carboxaldehyd, Limonen, Linalool, CI 26100', 'info'=>'Giúp cải thiện tình trạng bên ngoài của sẹo, vết rạn da và da không đều màu. Sản phẩm này cũng được khuyên dùng cho da bị lão hóa và da bị mất nước.', 
            'price'=>200000, 'img'=>'P01977_1.jpg', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('name'=>'Khăn giấy ướt hương nhẹ an toàn cho bé Agi', 'type_id'=>8, 'describe'=>'Không có', 'info'=>'Mở nắp hộp, gỡ tem phía trong, rút từng tờ để sử dụng. Sau khi dùng xong đóng nắp hộp lai để giữ ẩm và kháng khuẩn.', 
            'price'=>200000, 'img'=>'P08882.png', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('name'=>'Giấy vệ sinh Pharmacity', 'type_id'=>8, 'describe'=>'100% bột giấy nguyên chất.', 'info'=>'Giấy vệ sinh Pharmacity 3 lớp ply mềm mại, dai và thấm hút.', 
            'price'=>200000, 'img'=>'P18568.png', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('name'=>'Sữa nước hương vani Abbott PediaSure cho trẻ 1-10 tuổi 180ml', 'type_id'=>5, 'describe'=>'Sữa nước hương vani Abbott PediaSure cho trẻ 1-10 tuổi 180ml bao gồm trẻ tăng trưởng kém (nhẹ cân, thấp còi, suy dinh dưỡng, hay ốm), trẻ biếng ăn, trẻ có nhu cầu năng lượng tăng cao.', 'info'=>'Sữa giàu Vitamins C, E & Selenium, thơm mùi vani được nhiều bé yêu thích, bổ sung thêm chất xơ trong thành phần dinh dưỡng giúp hỗ trợ hệ tiêu hóa tối đa, đẩy mạnh quá trình trao đổi chất, tăng khả năng hấp thu.', 
            'price'=>200000, 'img'=>'P18087.png', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('name'=>'Dầu gội trẻ em dạng sữa Cetaphil Baby Gentle Wash & Shampoo', 'type_id'=>5, 'describe'=>'Aqua, Sorbitol, Cocamidopropyl Betaine, Lauryl Glucoside, Glycerin, Panthenol, Coco-Glucoside, Glyceryl Oleate, Acrylates/C10-30 Alkyl Acrylate Rosspolymer, Aloe Barbadensis Leaf Juice Powder, Chamomilla Recutita Flower Extract, Citric Acid, Heliotropine, Hydrogenated Palm Glycerides Citrate, Hydrolyzed Wheat Protein, Parfum, Sodium Hydroxide, Tocopherol, Zinc Sulfate.', 'info'=>'Dầu gội dạng sữa Cetaphil Baby Gentle Wash & Shampoo chứa các thành phần rất lành tính và dịu nhẹ mang đến những ưu điểm “đẹp như mơ” dành cho các bé yêu. Với chiết xuất hoa cúc hữu cơ giúp cung cấp độ ẩm làm mềm da, cân bằng độ pH, làm dịu vùng da kích ứng và tăng tính đàn hồi cho da bé. Ngoài ra còn chứa thành phần glycerin và panthenol có tác dụng làm mềm mịn và dưỡng ẩm da tự nhiên, đồng thời hỗ trợ làm giảm da khô hay bong tróc.', 
            'price'=>200000, 'img'=>'P09428_3.jpg', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('name'=>'Hộp que thử Contour Plus', 'type_id'=>6, 'describe'=>'Que thử được thiết kế để dễ dàng "trích" lấy máu vào đầu mẫu thử. Chỉ cần mẫu máu nhỏ 0,6 μL.  Sử dụng que thử trước thời hạn sử dụng. Nhận kết quả sau 5 giây. Khả năng lấy mẫu Second-Chance cho phép bạn lấy thêm máu khi lượng máu lúc đầu không đủ để xét nghiệm', 'info'=>'Kết quả chính xác, Tiết kiệm que thử, Trả kết quả sau 5 giây', 
            'price'=>300000, 'img'=>'nqMjjvMJI0CYECRR5dcnx96HwgwAPKrx.jpg', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('name'=>'Acetylcystein 200mg Vidipha (Hộp 20 vỉ x 10 viên)', 'type_id'=>4, 'describe'=>'Mỗi gói 1g có chứa: Acetylcystein 200mg, lactose monohydrat, aspartam, acid ascorbic, màu vàng số 6 lake, mùi cam, silicon dioxid.', 'info'=>'Điều trị rối loạn tiết dịch phế quản, đặc biệt là trong các rối loạn phế quản cấp tính như viêm phế quản cấp và bệnh phổi tắc nghẽn mãn tính.', 
            'price'=>55000, 'img'=>'P17480_11.png', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
            array('name'=>'Avircrem 5g (Hộp 1 tuýp)', 'type_id'=>4, 'describe'=>'Acyclovir 250mg, Cremophor A6, Cremophor A25, Celos†edryi Alcohol, Glyceryl monosfedrdt, lsoproDyl myristat, Paroffin lỏng, SimeThicon, Propylen glycol, Dinatri ederot, Methylpdraben, Propyiparaben, Nước tinh khiết', 'info'=>'Điều trị các trường hợp nhiễm virus Herpes simplex trên da.', 
            'price'=>25000, 'img'=>'P19451_1_l.png', 'created_at'=>Carbon::now('Asia/Ho_Chi_Minh'), 'updated_at'=>Carbon::now('Asia/Ho_Chi_Minh')),
        ]);
    }
}
