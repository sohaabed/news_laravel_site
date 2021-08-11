<x-panel-layout>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header" style="margin-top: 0px;">
                <h1 style="color: red;opacity:70%;">Notification</h1>
            </div>


            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">



                        </div>
                        <div class="body">




                            <div class="table-responsive" style="margin-top: 30px;">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>

                                        <tr style="background:red; color:white;opacity: 80%;text-align: center;">
                                            <th></th>
                                            <th>Notification</th>
                                            <th>From</th>
                                            <th>To Category </th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($notifications as $notification)
                                        <tr>

                                            @if($notification->read()==true) @else @endif
                                            <td style="width: 50px;" > <i class="material-icons" @if($notification->read()!==true) style="color:red;opacity: 80%;" @endif>notifications</i></td>
                                            
                                                <td > <a href="{{$notification->data['action']}}" style="opacity:80%;color:black">{{$notification->data['body']}}  </a></td>
                                           
                                            <td >{{$notification->data['auther']}}</td>
                                            <td >{{$notification->data['category']}} </td>

                                            @endforeach
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