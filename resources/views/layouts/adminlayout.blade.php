<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
       {{-- adminlayout css  --}}
   <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
       {{-- all dashboard --}}
   
   
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="#" class="d-flex align-items-center mb-3 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-4">LuxeLayers</span>
            </a>
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link text-white">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('client.order')}}" class="nav-link text-white">
                        <i class="fas fa-box"></i> Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('product.index')}}" class="nav-link text-white">
                        <i class="fas fa-cogs"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('product.create')}}" class="nav-link text-white">
                        <i class="fas fa-plus"></i> Add Product
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category.create')}}" class="nav-link text-white">
                        <i class="fas fa-th-large me-2"></i> Category
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
            <hr>
        </div>

        <!-- Main Content -->
        <div class="content flex-grow-1 ms-280">
            
                   
                        @yield('content')
                    
               
        </div>

        <!-- Sidebar Toggle Button (Mobile) -->
        <button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>
    </div>

    <!-- Modal for Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to log out?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="{{ route('login')}}" id="logoutConfirm" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }
    </script>
    
</body>

</html>
