<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Prework</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" href="/">Catalogue</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cart.index') }}">Cart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('order.index') }}">Order</a>
            </li>
            
        </ul>
        <form class="d-flex">
            <a id="linkNotify" href="#" class="btn btn-primary position-relative">
                Notification
            </a>
        </form>
        </div>
    </div>
</nav>