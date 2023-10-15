<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>

<section id="primary" class="content-area">
<div id="main" class="site-main" role="main">

<?php while ( have_posts() ) : the_post(); ?>

<section>

    <div class="container-fluid">

        <div class="row">

            <div class="col-12 px-0">

                <?php
                    $altTitle = get_the_title();
                    
                    the_post_thumbnail('post-thumbnail', 
                        array(
                            'class' => 'img-fluid w-100',
                            'alt'   => $altTitle,
                    ));
                ?>
            </div>
        </div>
    </div>
</section>

<!-- news -->
<section class="l-news u-border-top-2 u-border-color-primary my-4">

    <div class="container">

        <div class="row">

            <div class="col-12">

                <div class="row">
                    
                    <div class="col-lg-10 offset-md-1 d-flex flex-column flex-md-row align-items-center mb-3">
                        <h3 class="c-title u-font-weight-bold text-uppercase u-color-folk-white u-bg-folk-primary py-3 px-4">
                            <span class="u-font-weight-medium u-color-folk-white mr-2">//</span> Notícias
                        </h3>

                        <p class="c-text-pattern u-line-height-100 u-font-weight-semibold mb-0 ml-3">
                            Fique por dentro de tudo o que está <br>
                            acontecendo em nossas paróquias
                        </p>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-6 my-3 my-lg-0">

                        <div class="card border-0 u-bg-folk-theme">

                            <div class="card-img py-2 px-1">
                                <img
                                class="img-fluid w-100 h-100"
                                src="<?php echo get_template_directory_uri()?>/../wp-bootstrap-starter-child/assets/images/news-image-1.png"
                                alt="">
                            </div>

                            <div class="card-body mt-n4 pt-0">

                                <div class="d-flex justify-content-center">
                                    <p class="l-news__highlight__card-relevance d-inline-flex u-font-weight-bold u-color-folk-white u-bg-folk-theme py-2 px-5">
                                        <span class="u-font-weight-medium u-color-folk-white mr-2">//</span> Destaque
                                    </p>
                                </div>

                                <h6 class="l-news__highlight__card-title u-line-height-100 u-font-weight-extrabold u-color-folk-white mt-2">
                                    Disponível para download
                                    o subsídio do Tríduo de
                                    Dom Bosco 2021
                                </h6>

                                <p class="l-news__highlight__card-info u-line-height-100 mt-3">
                                    <span class="u-font-weight-semibold u-color-folk-white">por Inspetoria São Pio X</span> <br>
                                    <span class="u-font-weight-bold u-color-folk-white">em 11/08/2021</span>
                                </p>

                                <p class="l-news__highlight__card-excerpt u-font-weight-semibold u-color-folk-white">
                                    (Curitiba, PR) A partir de 13 de agosto,iniciamos, com
                                    muita alegria, o tríduo em preparação ao dia que
                                    comemoramos o nascimento do nosso [...]
                                </p>

                                <div class="row">

                                    <div class="col-md-6 mt-3">
                                        <a
                                        class="l-news__highlight__card-read-more u-line-height-100 hover:u-opacity-8 d-block u-font-weight-bold text-center text-decoration-none u-color-folk-white u-bg-folk-primary py-3 px-5"
                                        href="#">
                                            Ler mais
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">

                        <div class="row">
                            
                            <div class="col-12 my-3 my-lg-0">

                                <?php
                                    $paroquia_post_link = get_field( 'link_do_post_paroquias', 'option' );
                                    $paroquia_category = get_field( 'categoria_do_post_paroquias', 'option' );
                                    
                                    $request_posts = wp_remote_get( $paroquia_post_link );

                                    if(!is_wp_error( $request_posts )) :
                                        $body = wp_remote_retrieve_body( $request_posts );
                                        $data = json_decode( $body );
                                        $status = false;
                                        if(!is_wp_error( $data )) :
                                            foreach( $data as $rest_post ) :
                                                foreach($rest_post->child_category as $categories) :
                                                    if($categories == $paroquia_category) :
                                                        $status = true;
                                ?>
                                                        <div class="card border-0">

                                                            <div class="card-img l-news__medium__card-img">
                                                                <img
                                                                class="img-fluid w-100 h-100"
                                                                src="<?php echo $rest_post->featured_image_src; ?>"
                                                                alt="<?php echo $rest_post->title->rendered; ?>">
                                                            </div>

                                                            <div class="card-body mt-2 pt-0 px-0">

                                                                <h6 class="l-news__medium__card-title u-line-height-100 u-font-weight-extrabold mb-0">
                                                                    <!-- Secretários Inspetoriais participam de 
                                                                    reunião online -->

                                                                    <?php echo $rest_post->title->rendered; ?>
                                                                </h6>

                                                                <p class="l-news__medium__card-info u-line-height-100">
                                                                    <span class="u-font-weight-semibold">por Inspetoria São Pio X</span> <br>
                                                                    <span class="u-font-weight-bold u-color-folk-theme">
                                                                        <!-- em 11/08/2021 -->

                                                                        <?php 
                                                                            echo 'em ' . $rest_post->post_date;
                                                                        ?>
                                                                    </span>
                                                                </p>

                                                                <div class="row">

                                                                    <div class="col-md-5">
                                                                        <a
                                                                        class="l-news__medium__card-read-more u-line-height-100 hover:u-opacity-8 d-block u-font-weight-bold text-center text-decoration-none u-color-folk-white u-bg-folk-theme py-2 px-5"
                                                                        href="<?php echo esc_url( $rest_post->link ); ?>">
                                                                            Ler mais
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                <?php               endif;
                                                endforeach;
                                                
                                                if($status) 
                                                    break;
                                            endforeach;
                                        endif; 
                                    endif; 
                                ?>
                            </div>

                            <div class="col-md-6 my-3 my-lg-0">

                                <div class="card h-100 border-0">

                                    <div class="card-img">
                                        <img
                                        class="img-fluid w-100 h-100"
                                        src="<?php echo get_template_directory_uri()?>/../wp-bootstrap-starter-child/assets/images/news-image-3.png"
                                        alt="">
                                    </div>

                                    <div class="card-body d-flex flex-column justify-content-between mt-2 pt-0 px-0">

                                        <div>

                                            <h6 class="l-news__small__card-title u-line-height-100 u-font-weight-extrabold mb-1">
                                                Somos a família da AMJ 
                                                2021
                                            </h6>

                                            <p class="l-news__small__card-info u-line-height-100">
                                                <span class="u-font-weight-semibold">por Tarcizio Paulo Odelli</span> <br>
                                                <span class="u-font-weight-bold u-color-folk-theme">em 19/07/2021</span>
                                            </p>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-10">
                                                <a
                                                class="l-news__small__card-read-more u-line-height-100 hover:u-opacity-8 d-block u-font-weight-bold text-center text-decoration-none u-color-folk-white u-bg-folk-theme py-2 px-5"
                                                href="#">
                                                    Ler mais
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 my-3 my-lg-0">

                                <div class="card h-100 border-0">

                                    <div class="card-img">
                                        <img
                                        class="img-fluid w-100 h-100"
                                        src="<?php echo get_template_directory_uri()?>/../wp-bootstrap-starter-child/assets/images/news-image-4.png"
                                        alt="">
                                    </div>

                                    <div class="card-body d-flex flex-column justify-content-center mt-2 pt-0 px-0">

                                        <div>

                                            <h6 class="l-news__small__card-title u-line-height-100 u-font-weight-extrabold mb-1">
                                                Inglês para vida: conheça 
                                                o projeto do Colégio 
                                                Salesiano de Rio do Sul
                                            </h6>

                                            <p class="l-news__small__card-info u-line-height-100">
                                                <span class="u-font-weight-semibold">por Colégio Dom Bosco/Rio do Sul</span> <br>
                                                <span class="u-font-weight-bold u-color-folk-theme">em 03/08/2021</span>
                                            </p>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-10">
                                                <a
                                                class="l-news__small__card-read-more u-line-height-100 hover:u-opacity-8 d-block u-font-weight-bold text-center text-decoration-none u-color-folk-white u-bg-folk-theme py-2 px-5"
                                                href="#">
                                                    Ler mais
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end news -->

<?php endwhile; ?>

</div><!-- #main -->
</section><!-- #primary -->

<?php

get_footer();
