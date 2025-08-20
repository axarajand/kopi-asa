@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <div class="widget-first">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-secondary-subtle p-2 me-2">
                                <iconify-icon icon="tabler:currency-dollar" class="align-middle text-dark fs-26 mb-0"></iconify-icon>
                            </div>
                            <p class="mb-0 text-dark fs-16">Total Revenue</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="fs-24 fw-medium text-dark mb-0 me-3">$50,457</h3>
                            <div class="d-flex align-items-center">
                                <span class="me-2 rounded-2 badge fs-12 badge-soft-success fw-medium">
                                    <i class="mdi mdi-trending-up fs-14"></i> +1.31%
                                </span>
                                <p class="text-muted fs-14 mb-0 text-center">vs last month</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <div class="widget-first">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-primary-subtle p-2 me-2">
                                <iconify-icon icon="tabler:user-share" class="align-middle text-dark fs-26 mb-0"></iconify-icon>
                            </div>
                            <p class="mb-0 text-dark fs-16">New Leads Added</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="fs-24 fw-medium text-dark mb-0 me-3">150</h3>
                            <div class="d-flex align-items-center">
                                <span class="me-2 rounded-2 badge fs-12 badge-soft-danger fw-medium">
                                    <i class="mdi mdi-trending-down fs-14"></i> -5.35%
                                </span>
                                <p class="text-muted fs-14 mb-0">vs last month</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <div class="widget-first">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-success-subtle p-2 me-2">
                                <iconify-icon icon="tabler:users" class="align-middle text-dark fs-26 mb-0"></iconify-icon>
                            </div>
                            <p class="mb-0 text-dark fs-16">Conversion Rate</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="fs-24 fw-medium text-dark mb-0 me-3">25%</h3>
                            <div class="d-flex align-items-center">
                                <span class="me-2 rounded-2 badge fs-12 badge-soft-success fw-medium">
                                    <i class="mdi mdi-trending-up fs-14"></i> +2.37%
                                </span>
                                <p class="text-muted text-center fs-14 mb-0">vs last month</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <div class="widget-first">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-danger-subtle p-2 me-2">
                                <iconify-icon icon="tabler:circle-check" class="align-middle text-dark fs-26 mb-0"></iconify-icon>
                            </div>
                            <p class="mb-0 text-dark fs-16">Total Deals Closed</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="fs-24 fw-medium text-dark mb-0 me-3">30</h3>
                            <div class="d-flex align-items-center">
                                <span class="me-2 rounded-2 badge fs-12 badge-soft-success fw-medium">
                                    <i class="mdi mdi-trending-up fs-14"></i> +3.28%
                                </span>
                                <p class="text-muted text-center fs-14 mb-0">vs last month</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title text-dark mb-0">Overview</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="p-2">
                        <div id="overview" class="apex-charts"></div>
                    </div>
                    <div class="row">
                        <div class="col-xxl-3 col-md-6">
                            <div class="card mb-lg-0">
                                <div class="card-body p-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="bg-light p-2 rounded-2">
                                            <iconify-icon icon="tabler:garden-cart" class="align-middle text-primary fs-26 mb-0"></iconify-icon>
                                        </div>
                                        <div class="text-end">
                                            <h5 class="text-dark fs-14 mb-1">Sales</h5>
                                            <h6 class="text-muted fw-medium mb-0 fs-16">$540k</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6">
                            <div class="card mb-lg-0">
                                <div class="card-body p-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="bg-light p-2 rounded-2">
                                            <iconify-icon icon="tabler:chart-column" class="align-middle text-primary fs-26 mb-0"></iconify-icon>
                                        </div>
                                        <div class="text-end">
                                            <h5 class="text-dark fs-14 mb-1">Income</h5>
                                            <h6 class="text-muted fw-medium mb-0 fs-16">$200k</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6">
                            <div class="card mb-lg-0">
                                <div class="card-body p-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="bg-light p-2 rounded-2">
                                            <iconify-icon icon="tabler:stairs-up" class="align-middle text-primary fs-26 mb-0"></iconify-icon>
                                        </div>
                                        <div class="text-end">
                                            <h5 class="text-dark fs-14 mb-1">Profit</h5>
                                            <h6 class="text-muted fw-medium mb-0 fs-16">$265k</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6">
                            <div class="card mb-lg-0">
                                <div class="card-body p-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="bg-light p-2 rounded-2">
                                            <iconify-icon icon="tabler:stairs-down" class="align-middle text-primary fs-26 mb-0"></iconify-icon>
                                        </div>
                                        <div class="text-end">
                                            <h5 class="text-dark fs-14 mb-1">Expenses</h5>
                                            <h6 class="text-muted fw-medium mb-0 fs-16">$485k</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xl-3">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title text-dark mb-0">Lead Sources</h5>
                        <div class="ms-auto">
                            <button class="btn btn-sm bg-light text-muted dropdown-toggle fw-semibold border" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Weekly<i class="mdi mdi-chevron-down ms-1 fs-14"></i></button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Weekly</a>
                                <a class="dropdown-item" href="#">Monthly</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="leadChart" class="apex-charts"></div>
                    <div class="row mt-3">
                        <div class="col-12 mb-2">
                            <div class="d-flex justify-content-between align-items-center p-1 border border-dashed rounded-2">
                                <div>
                                    <i class="mdi mdi-circle fs-13 align-middle me-1" style="color: #008080;"></i>
                                    <span class="align-middle fs-13 fw-semibold">Social Media</span>
                                </div>
                                <span class="fw-semibold text-muted float-end fs-13">50.24%</span>
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="d-flex justify-content-between align-items-center p-1 border border-dashed rounded-2">
                                <div>
                                    <i class="mdi mdi-circle fs-12 align-middle me-1" style="color: #66b2b2;"></i>
                                    <span class="align-middle fs-13 fw-semibold">Website</span>
                                </div>
                                <span class="fw-semibold text-muted float-end fs-13">5.23%</span>
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="d-flex justify-content-between align-items-center p-1 border border-dashed rounded-2">
                                <div>
                                    <i class="mdi mdi-circle fs-12 align-middle me-1" style="color: #99cccc;"></i>
                                    <span class="align-middle fs-13 fw-semibold">Email</span>
                                </div>
                                <span class="fw-semibold text-muted float-end fs-13">15.18%</span>
                            </div>
                        </div>
                        <div class="col mb-0">
                            <div class="d-flex justify-content-between align-items-center p-1 border border-dashed rounded-2">
                                <div>
                                    <i class="mdi mdi-circle fs-12 align-middle me-1" style="color: #cce5e5;"></i>
                                    <span class="align-middle fs-13 fw-semibold">Affiliates</span>
                                </div>
                                <span class="fw-semibold text-muted float-end fs-13">20.02%</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-between align-items-center p-1 border border-dashed rounded-2">
                                <div>
                                    <i class="mdi mdi-circle fs-12 align-middle me-1" style="color: #e6f2f2;"></i>
                                    <span class="align-middle fs-13 fw-semibold">Direct</span>
                                </div>
                                <span class="fw-semibold text-muted float-end fs-13">45.48%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title text-dark mb-0">Tasks List</h5>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled task-list-tab mb-0">
                        <li>
                            <div class="d-flex mb-2 pb-1">
                                <div class="form-check form-todo d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input rounded-circle mt-0 fs-16 me-2" id="customCheck1">
                                    <label class="form-check-label text-dark fw-medium fs-14" for="customCheck1">Plan Product Launch Event</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex mb-2 pb-1">
                                <div class="form-check form-todo d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input rounded-circle mt-0 fs-16 me-2" id="customCheck2">
                                    <label class="form-check-label text-dark fw-medium fs-14" for="customCheck2">Prepare Monthly Sales Report</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex mb-2 pb-1">
                                <div class="form-check form-todo d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input rounded-circle mt-0 fs-16 me-2" id="customCheck3">
                                    <label class="form-check-label text-dark fw-medium fs-14" for="customCheck3">Finalize Website Design</label>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="row g-2 mt-3">
                        <div class="col mt-0">
                            <input type="text" class="form-control" placeholder="Add Task Name">
                        </div>
                        <div class="col-auto mt-0">
                            <a href="#!" class="btn btn-primary">+ Add Task</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xl-8">
            <div class="card overflow-hidden">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title text-dark mb-0">Top Opportunities</h5>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive mt-0">
                        <table class="table table-custom mb-0">
                            <thead>
                                <tr class="bg-light">
                                    <th class="text-muted">Client</th>
                                    <th class="text-muted">Stage</th>
                                    <th class="text-muted">Close Date</th>
                                    <th class="text-muted">Revenue</th>
                                    <th class="text-muted">Owner</th>
                                    <th class="text-muted">Close %</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle p-2 bg-light">
                                            <p class="mb-0 fw-medium fs-12">AC</p>
                                        </div>
                                        <h5 class="fs-14 fw-medium text-dark mb-0">John Hamilton</h5>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary-subtle text-secondary fs-12 fw-normal">Negotiation</span>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-14 fw-medium">Nov 20, 2024</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-14 fw-medium">$20000</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-14 fw-medium">Jane Smith</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-14 fw-medium">80%</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin-assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/pages/crm-dashboard.init.js') }}"></script>
@endpush