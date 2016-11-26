@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create New Deploy</div>

                <div class="panel-body">
                                <form method="post" action="../deploy/boot">
                                    {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>App Name</label>
                                                    <input name="name" type="text" required="" class="form-control border-input" value="{{ preg_replace('/[^a-zA-Z]/', '', $data->name) }}" placeholder="A cool name for your application">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Git repository URL</label>
                                                    <input name="repository" readonly="" type="text" class="form-control border-input" value="{{ $data->repository }}" placeholder="A cool name for your application">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Size</label>
                                                    <select name="size" class="form-control border-input" required="" placeholder="Choose your size">
                                                        <!-- options -->
                                                        <option value="512mb">512 MB/20 GB $5/month</option>
                                                        <option value="1gb">1 GB/30 GB $10/month</option>
                                                        <option value="2gb">2 GB/40 GB $20/month</option>
                                                        <option value="4gb">4 GB/60 GB $40/month</option>
                                                        <option value="8gb">8 GB/80 GB $80/month</option>
                                                        <option value="16gb">16 GB/160 GB $160/month</option>
                                                        <option value="m-16gb">16 GB/30 GB $120/month</option>
                                                        <option value="32gb">32 GB/320 GB $320/month</option>
                                                        <option value="m-32gb">32 GB/90 GB $240/month</option>
                                                        <option value="48gb">48 GB/480 GB $480/month</option>
                                                        <option value="m-64gb">64 GB/200 GB $480/month</option>
                                                        <option value="64gb">64 GB/640 GB $640/month</option>
                                                        <option value="m-128gb">128 GB/340 GB $960/month</option>
                                                        <option value="m-224gb">224 GB/500 GB $1680/month</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label>Location</label>
                                                <select name="location" class="form-control border-input">
                                                    <option value="nyc1">New York 1</option>
                                                    <option value="nyc2">New York 2</option>
                                                    <option value="sfo1">San Francisco 1</option>
                                                    <option value="ams2">Amsterdam 2</option>
                                                    <option value="sgp1">Singapore 1</option>
                                                    <option value="lon1">London 1</option>
                                                    <option value="nyc3">New York 3</option>
                                                    <option value="ams3">Amsterdam 3</option>
                                                    <option value="fra1">Frankfurt 1</option>
                                                    <option value="sfo2">San Francisco 2</option>
                                                    <option value="tor1">Toronto 1</option>
                                                    <option value="blr1">Bangalore 1</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>SSH keys</label>
                                                    <textarea class="form-control border-input" required="" name="ssh" placeholder="Insert SSH keys" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>ipv6</label>
                                                    <input name="ipv6" type="checkbox" class="border-input">
                                                </div>
                                            </div>
                                    
                                            <div class="col-md-6">
                                                <span class="form-group">
                                                    <label>Backups</label>
                                                    <input name="backups" type="checkbox" class="border-input" placeholder="Company">
                                                    <div class="alert alert-warning">
                                                        <span><b> Warning - </b> This would cost you additional <b>20%</b> of your DigitalOcean droplet price.</span>
                                                    </div>
                                                </span>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                   
                                                    <label>Image</label>
                                                    <input class="form-control border-input" name="image" value="{{ $data->image }}" readonly="">
                                                </div>
                                                    
                                            </div>


                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-info btn-fill btn-wd">Create Droplet!</button>
                                            </div>
                                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection