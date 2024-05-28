<?php
 
 namespace App\Admin\Extensions\Tools;
 
 use Encore\Admin\Admin;
 use Encore\Admin\Grid\Tools\AbstractTool;
 
 class CsvImport extends AbstractTool
 {
     protected function script()
     {
         return <<< SCRIPT
 
         $('.csv-import').click(function() {
             var select = document.getElementById('files');
             document.getElementById("files").click();
             select.addEventListener('change',function() {
                 var formdata = new FormData();
                 formdata.append( "file", $("input[name='product']").prop("files")[0] );
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });
                 $.ajax({
                     type : "POST",
                     url : "products/import",
                     data : formdata,
                     processData : false,
                     contentType : false,
                     success: function (response) {
                         $.pjax.reload("#pjax-container");
                         toastr.success('CSVのアップロードが成功しました');
                     }
                 });
             });
         });
 
         SCRIPT;
     }
 
     public function render()
     {
         Admin::script($this->script());
         return view('csv_upload');
     }
 }
