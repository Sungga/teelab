    <!-- BEGIN SLIDER -->
    <section id="slider">
        <div class="grid" style="overflow: hidden;">
            <div class="slider__container">
                <!-- <img src="./templates/access/img/slider1.jpg" alt="">
                <img src="./templates/access/img/slider2.jpg" alt="">
                <img src="./templates/access/img/slider3.jpg" alt=""> -->
                <?php
                foreach($website_covers as $website_cover_item) {
                ?>
                    <img src="./model/uploads/<?php echo $website_cover_item['website_cover_name']; ?>" alt="">
                <?php
                }
                ?>

                <div class="slider__dot">
                    <!-- <div class="slider__dot--item focus"></div>
                    <div class="slider__dot--item"></div>
                    <div class="slider__dot--item"></div> -->
                </div>
            </div>
        </div>
    </section>

    <script src="./templates/access/js/animation_slider.js"></script>