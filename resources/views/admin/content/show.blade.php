<x-panel-layout>



    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
            <h1 style="color: red;opacity:70%;">Show Content</h1>    
            </div>


            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">

                        <h4 style="color:black;opacity: 70%;">
                               {{ $content->short_description}}
                            </h4>

                        </div>
                        <div class="body">


                         

                            <div class="table-responsive" style="margin-top: 30px;">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>

                                        <tr style="background:red; color:white;opacity: 80%;">

                                            <th>Category Name</th>
                                            <th>Description</th>
                                            <th>Readers</th>
                                            <th>image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr style="background:red; color:white;opacity: 80%;">

                                            <th>Category Name</th>
                                            <th>Description</th>
                                            <th>Readers</th>
                                            <th>image</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <tr>


                                            <td style=" line-height: 121px;">{{$content->category->title}}</td>
                                            <td style=" line-height: 121px;">{{$content->short_description}}</td>
                                            <td style=" line-height: 121px;">{{$content->visitor}}</td>
                                            <td style=" line-height: 121px;"><img src="{{$content->image_url}}" alt="{{$content->image_url}}" height="100px" width="80px"></td>

                                            <td style=" line-height: 121px;">
                                                <a href="{{route('user.content.edit',$content->id)}}"><span class="material-icons btn btn-primary " style=" margin-right: 20px; font-size: large;opacity: 80%">mode_edit</span></a>

                                                <form action="{{route('user.content.delete',$content->id)}}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" id="delete" class=" btn btn-danger" style="opacity: 80%"> <span class="material-icons " style="font-size: 20px;top:2px;opacity: 80%">delete</span>
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>



                                    </tbody>
                                </table>
                            </div>



                            <div class="container " style=" margin-bottom:10px">

                                <a href="{{route('admin.home.')}}" style="color:red"> Go to admin panel<span class="material-icons">trending_flat</span></a>

                            </div>
                        </div>


                    </div>

                </div>


            </div>
            <!-- #END# Basic Examples -->

        </div>
        
    </section>

</x-panel-layout>