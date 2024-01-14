<div class="col">
    <div class="col-10 m-auto rounded-3 card mt-5 border-0">
        <h4 class="text-center pt-5">เพิ่มหมวดหมู่อาหาร</h4>

        <div class="px-5">
            <form class="px-4" action="../api/ac_product.php?ac=addType" method="post" id="frm_productType" enctype="multipart/form-data">
                <div class="mt-1">
                    <label class="form-label" for="">หมวดหมู่อาหาร</label>
                    <input class="form-control" type="text" name="type_name" id="type_name" placeholder="กรอกหมวดหมู่อาหาร">
                </div>
                <div class="mt-3">
                    <label class="form-label" for="">รูปภาพประกอบ</label>
                    <input type="file" name="type_img" id="type_img" class="form-control">
                </div>
                <div class="text-center py-4">
                    <button type="button" onclick="window.location.replace('index.php')" class="btn btn-outline-dark w-25 mx-1">ยกเลิก</button>
                    <button type="submit" class="btn btn-outline-success w-25 mx-1">ยืนยัน</button>
                </div>
            </form>
        </div>
    </div>
</div>