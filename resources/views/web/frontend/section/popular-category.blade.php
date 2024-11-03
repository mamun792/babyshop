<section class="popular-categories section-padding mt-15">
    <div class="container wow fadeIn animated">
        <h3 class="section-title mb-20"><span>Popular</span> Categories</h3>
        <div class="carausel-6-columns-cover position-relative">
            <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows"></div>
            <div class="carausel-6-columns" id="carausel-6-columns">
                @foreach ( $categories as  $categorie)
                    
                
                <div class="card-1">
                    <figure class="img-hover-scale overflow-hidden">
                        <a href="shop-grid-right.html"><img src="{{ asset($categorie->image_path) }}" alt=""></a>
                    </figure>
                    <h5><a href="shop-grid-right.html">{{ $categorie->name }}
                    </a></h5>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
