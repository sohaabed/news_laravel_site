﻿<x-user-panel-component>
<section class="content" style="    margin: 70px 100px 0 100px !important;">
        <div class="container-fluid" >
            <div class="block-header">
            <h1  style="color:red;opacity: 80%;">
                               NEWS
                            </h1>
            </div>
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background:red; color:white;opacity: 80%;" >
                            <h2 style="color:white">
                               Add new
                            </h2>
                        </div>
                        <div class="body">
                            <form id="form_validation" method="post" action="{{route('user.content.store')}}" enctype="multipart/form-data" >
                               @csrf
   @include('user.content._form',[
    
    'submit_button'=>'Add'])
</x-user-panel-component>