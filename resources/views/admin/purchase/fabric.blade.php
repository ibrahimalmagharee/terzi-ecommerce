@extends('layouts.admin')
@section('title')
    مبيعات منتجات|القماش
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> مبيعات منتجات القماش </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a></li>
                                <li class="breadcrumb-item active"> مبيعات منتجات القماش</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">

                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-content collapse show" id="viewDesigns">
                                    <div class="card-body card-dashboard table-responsive">
                                        <table class="table purchase-fabric-table">
                                            <thead>
                                            <tr>
                                                <th>التاجر </th>
                                                <th>الزبون </th>
                                                <th>اسم المنتج</th>
                                                <th>القسم</th>
                                                <th>تاريخ البيع</th>
                                                <th>عدد الأمتار</th>
                                                <th>الكمية</th>
                                                <th>السعر</th>
                                                <th>المجموع الكلي</th>

                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="8" style="text-align:right;  white-space: nowrap;">المجموع الكلي : </th>
                                                <th></th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                        <div class="row mt-1">
                                            <div class="col-md-3">
                                                <select name="vendor_id" data-vendor="0" id="vendor_id" class="form-control">
                                                    <optgroup label="الرجاء اختر التاجر">
                                                        <option value="">اختر التاجر</option>
                                                        @isset($data['vendors'])
                                                            @foreach($data['vendors'] as $vendor)
                                                                <option value="{{$vendor->name}}">{{$vendor->name}}</option>
                                                            @endforeach
                                                        @endisset
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" data-name="2" name="name" id="name_filter" class="form-control" placeholder="اسم المنتج">
                                            </div>
                                            <div class="col-md-3">
                                                <select name="category_id" data-category="3" id="category_id_filter" class="form-control">
                                                    <optgroup label="الرجاء اختر القسم">
                                                        <option value="">اختر القسم</option>
                                                        @isset($data['categories'] )
                                                            @foreach($data['categories'] as $category)

                                                                <option value="{{$category->name}}">{{$category->name}}</option>
                                                            @endforeach
                                                        @endisset
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="date" data-created="4" name="created_at" id="created_at_filter" class="form-control">
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>




@endsection

@section('script')
    <script type="text/javascript">

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //Show Table
            var purchaseFabricTable = $('.purchase-fabric-table').DataTable({
                processing: true,
                serverSide: false,
                ajax: "{{route("purchase.fabric")}}",
                columns: [
                    {data: 'vendor', name: 'vendor'},
                    {data: 'customer', name: 'customer'},
                    {data: 'name', name: 'name'},
                    {data: 'category', name: 'category'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'number_of_meters', name: 'number_of_meters'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'price', name: 'price'},
                    {data: 'total_price', name: 'total_price', orderable: false, searchable: false},
                ],
                language: {"url": "{{asset('/public/assets/admin/js/dataTableArabic.json')}}"},

                "dom":  '<"rt-buttons"Bf><"clear">ltip',
                "paging": true,
                "autoWidth": true,
                footerCallback: function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column( 8 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over this page
                    pageTotal = api
                        .column( 8, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    // Update footer
                    $( api.column( 8 ).footer() ).html(
                        '$'+pageTotal +' ( $'+ {{$total_price}} +' المجموع الكلي)'
                    );

                },

                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'اكسيل',
                        autoFilter: true,
                        sheetName: 'Exported data',
                        footer: true ,
                        exportOptions: {
                            orthogonal: 'excel',
                        },
                    },

                ],


            });

            $('select[name="vendor_id"]').on('change',function(){
                purchaseFabricTable.column($(this).data('vendor')).search($(this).val()).draw();

            });

            $('#name_filter').on('keyup',function(){
                purchaseFabricTable.column($(this).data('name')).search($(this).val()).draw();

            });

            $('select[name="category_id"]').on('change',function(){
                purchaseFabricTable.column($(this).data('category')).search($(this).val()).draw();

            });

            $('#created_at_filter').on('change',function(){
                purchaseFabricTable.column($(this).data('created')).search($(this).val()).draw();

            });

        });


    </script>
@endsection
