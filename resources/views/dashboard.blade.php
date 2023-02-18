@extends('layout.app')
@section('page-content')
    <div class="dashboard-menu">
        <div class="dashboard-header">
            <span>
                <h2 style="font-weight: bold;">Dashboard</h2>
            </span>
            <span><a href="" style="color:orangered;text-decoration:none">Home</a>/Dashboard</span>
        </div>
        <div class="widgets">
            <a href="{{ config('app.url') }}/products" style="text-decoration: none;">
                <div class="widget first">
                    <div class="widget-icon">
                        <i class='bx bxs-bowl-rice'></i>
                    </div>
                    <div class="widget-desc">
                        <span>Produts</span><br>
                        <span class="total-items">{{ $productNum }}</span>
                    </div>
                </div>
            </a>
            <div class="widget second">
                <div class="widget-icon">
                    <i class='bx bxs-user-account'></i>
                </div>
                <div class="widget-desc">
                    <span>Customers</span><br>
                    <span class="total-items">120</span>
                </div>
            </div>
            <a href="/sales" style="text-decoration: none">
                <div class="widget third">
                    <div class="widget-icon">
                        <i class='bx bx-dollar-circle'></i>
                    </div>
                    <div class="widget-desc">
                        <span>Sales</span><br>
                        <span class="total-items">120</span>
                    </div>
                </div>
            </a>
            <div class="widget four">
                <div class="widget-icon">
                    <i class='bx bxs-bowl-rice'></i>
                </div>
                <div class="widget-desc">
                    <span>Produts</span><br>
                    <span class="total-items">120</span>
                </div>
            </div>
        </div>
        <div class="stats-widgets-container">
            <div class="stat-widget">
                <h2>Most Sold Product</h2>
                @include('modules.sales.modals.saleschart')
            </div>
            <div class="stat-widget">
                <h2>Best Seller</h2>
                @include('modules.employee.modals.employeechart')
            </div>
        </div>
    </div>
@endsection
