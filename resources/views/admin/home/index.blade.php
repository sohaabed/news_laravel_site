
<x-panel-layout>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h1 style="color: red;opacity:80%;">DASHBOARD</h1>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL READERS</div>
                            <div class="number count-to" data-from="0" data-to="{{$total_visit}}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">list</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL CATEGORIES</div>
                            <div class="number count-to" data-from="0" data-to="{{$total_category}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">edit</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL NEWS</div>
                            <div class="number count-to" data-from="0" data-to="{{$total_new}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL USERS</div>
                            <div class="number count-to" data-from="0" data-to="{{$total_user}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- #END# Widgets -->
           
           
           

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="color: red;opacity:80%">TASK INFOS</h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead style="background-color: red;opacity:80%;color:white;text-align:center">
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Total News</th>
                                            <th>Readers</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                       
                                        @foreach($categories as $category)
                                        
                                        <tr  style="text-align: center;">
                                            
                                        <td>{{$count++}}</td>
                                            <td>{{$category->title}}</td>
                                            <td>{{$category->total_news}}</td>
                                            <td>{{$category->visitor}}</td>
                                            
                                        </tr>
                                        @endforeach
                                       
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container " style=" margin-bottom:10px">

<a href="{{route('home')}}" style="color:red"> Go to the website<span class="material-icons">trending_flat</span></a>

</div>
                </div>
                <!-- #END# Task Info -->
               
                <!-- #END# Browser Usage -->
            </div>
    
        </div>
    </section>
</x-panel-layout>