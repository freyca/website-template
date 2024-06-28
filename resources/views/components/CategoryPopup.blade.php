<div class="dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Categorías
    </a>
    <div class="dropdown-menu" aria-labelledby="categoriesDropdown">
        <div class="container">
            <ul class="nav nav-tabs" id="categoryTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="agricola-tab" data-bs-toggle="tab" data-bs-target="#agricola" type="button" role="tab" aria-controls="agricola" aria-selected="true">Agrícola</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="forestal-tab" data-bs-toggle="tab" data-bs-target="#forestal" type="button" role="tab" aria-controls="forestal" aria-selected="false">Forestal</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="jardineria-tab" data-bs-toggle="tab" data-bs-target="#jardineria" type="button" role="tab" aria-controls="jardineria" aria-selected="false">Jardinería</button>
                </li>
            </ul>
            <div class="tab-content" id="categoryTabsContent">
                <div class="tab-pane fade show active" id="agricola" role="tabpanel" aria-labelledby="agricola-tab">
                    <div id="agricolaCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('images/agricola.molinosYDesgranadoras_1.jpg') }}" class="d-block w-100" alt="Agrícola 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/agricola.molinosYDesgranadoras_2.jpg') }}" class="d-block w-100" alt="Agrícola 2">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/agricola.molinosYDesgranadoras_3.jpg') }}" class="d-block w-100" alt="Agrícola 3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#agricolaCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#agricolaCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="tab-pane fade" id="forestal" role="tabpanel" aria-labelledby="forestal-tab">
                    <div id="forestalCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('images/forestal.astilladoras_1.jpg') }}" class="d-block w-100" alt="Forestal 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/forestal.astilladoras_2.jpg') }}" class="d-block w-100" alt="Forestal 2">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/forestal.astilladoras_3.jpg') }}" class="d-block w-100" alt="Forestal 3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#forestalCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#forestalCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="tab-pane fade" id="jardineria" role="tabpanel" aria-labelledby="jardineria-tab">
                    <div id="jardineriaCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('images/jardineria.cortacesped_1.jpg') }}" class="d-block w-100" alt="Jardinería 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/jardineria.cortacesped_2.jpg') }}" class="d-block w-100" alt="Jardinería 2">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/jardineria.cortacesped_3.jpg') }}" class="d-block w-100" alt="Jardinería 3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#jardineriaCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#jardineriaCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
