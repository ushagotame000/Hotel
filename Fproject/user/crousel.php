<style>
    "/* transition duration to control the speed of fade effect */\r\n.carousel-item {\r\n    transition: transform 2.6s ease-in-out;\r\n}\r\n\r\n.carousel-fade .active.carousel-item-start,\r\n.carousel-fade .active.carousel-item-end {\r\n    transition: opacity 0s 2.6s;\r\n}"
</style>

<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
    <ol class="carousel-indicators">
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="//via.placeholder.com/1200x400/cc09f0" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="//via.placeholder.com/1200x400/5609f0" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="//via.placeholder.com/1200x400/cc54f0" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" data-bs-target="#carouselExampleIndicators" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" data-bs-target="#carouselExampleIndicators" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </a>
</div>