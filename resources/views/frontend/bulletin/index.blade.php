@extends('layout.frontend.general.layout')

@section('title', 'Bulletin')

@section('css')
    <link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/css/animate.css') !!}">
    <link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/css/font.css') !!}">
    <link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/css/li-scroller.css') !!}">
    <link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/css/slick.css') !!}">
    <link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/css/jquery.fancybox.css') !!}">
    <link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/css/theme.css') !!}">
    <link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/css/news/style.css') !!}">
    {!! Html::style( $pathp.'assets/backend/porto-admin/vendor/bootstrap/css/bootstrap.css') !!}
    {!! Html::style($pathp.'assets/backend/porto-admin/vendor/pnotify/pnotify.custom.css') !!}
    <style type="text/css">
      .img-recent{
        width: 250px;
        height: 250px;
      }
    </style>
@endsection

@section('content')
    <section id="newsSection">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="latest_newsarea"> <span>@lang('general.title.latest_news')</span>
            <ul id="ticker01" class="news_sticker">
              @foreach($bulletin_news as $key => $bulletin)
                <li><a href="{{ route('news-detail', $bulletin->slug) }}" target="_blank"><img src="{{ asset($pathp.'storage/news'.'/'.$bulletin->img_url) }}" alt="News">{{ $bulletin->title }}</a></li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section id="sliderSection">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
          <div class="slick_slider">
            @foreach($bulletin_news as $key => $bulletin)
                <div class="single_iteam"> <a href="{{ route('news-detail', $bulletin->slug) }}" target="_blank"><img src="{{ asset($pathp.'storage/news'.'/'.$bulletin->img_url) }}" alt="News"></a>
                  <div class="slider_article">
                    <h2><a class="slider_tittle" href="{{ route('news-detail', $bulletin->slug) }}">{{ $bulletin->title }}</a></h2>
                    <p>{!! str_limit($bulletin->content, 150) !!}</p>
                  </div>
                </div>
            @endforeach
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="latest_post">
            <h2><span>@lang('general.title.all_news')</span></h2>
            <div class="latest_post_container">
              <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
              <ul class="latest_postnav">
                @foreach($all_news as $keyOfNews =>$news)

                  <li>
                    <div class="media"> <a href="{{ route('news-detail', $news->slug) }}" target="_blank" class="media-left"> <img alt="" src="{{ asset($pathp.'storage/news'.'/'.$news->img_url) }}"> </a>
                      <div class="media-body"> <a href="{{ route('news-detail', $news->slug) }}" target="_blank" class="catg_title"> {{ $news->title }}</a><br> 
                        {{ eform_date_news($news->publish_date) }}
                      </div>
                    </div>
                  </li>
                @endforeach
              </ul>
              <div id="next-button"><i class="fa  fa-chevron-down"></i></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="contentSection">
        <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="left_content">
              <div class="single_post_content">
                <h2><span>@lang('general.title.latest_article')</span></h2>
                <div class="single_post_content_left">
                  <ul class="business_catgnav  wow fadeInDown">
                    @foreach($singleArticle as $singleKey => $getSingleArticle)
                        <li>
                          <figure class="bsbig_fig"> <a href="{{ route('news-detail', $getSingleArticle->slug) }}" class="featured_img" target="_blank"><img class="img-recent" src="{{ asset($pathp.'storage/news'.'/'.$getSingleArticle->img_url) }}" alt="big image"> <span class="overlay"></span> </a>
                            <figcaption> <a href="{{ route('news-detail', $getSingleArticle->slug) }}" target="_blank">{{ $getSingleArticle->title }}</a> </figcaption>
                            <p>{!! str_limit($getSingleArticle->content, 150) !!}</p>
                          </figure>
                        </li>
                    @endforeach
                  </ul>
                </div>
                <div class="single_post_content_right">
                  <ul class="spost_nav">
                    @foreach($articles as $articleKey => $article)
                        <li>
                          <div class="media wow fadeInDown"> <a href="{{ route('news-detail', $article->slug) }}" class="media-left" target="_blank"> <img alt="recent of image" src="{{ asset($pathp.'storage/news'.'/'.$article->img_url) }}"> </a>
                            <div class="media-body"> <a href="{{ route('news-detail', $article->slug) }}" class="catg_title" target="_blank"> {{ $article->title }}</a> </div>
                          </div>
                        </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
@endsection

@section('scripts')
    <script src="{!! asset($pathp.'assets/frontend/js/wow.min.js') !!}"></script>
    <script src="{!! asset($pathp.'assets/frontend/js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset($pathp.'assets/frontend/js/slick.min.js') !!}"></script>
    <script src="{!! asset($pathp.'assets/frontend/js/jquery.li-scroller.1.0.js') !!}"></script>
    <script src="{!! asset($pathp.'assets/frontend/js/jquery.newsTicker.min.js') !!}"></script>
    <script src="{!! asset($pathp.'assets/frontend/js/jquery.fancybox.pack.js') !!}"></script>
    <script src="{!! asset($pathp.'assets/frontend/js/custom.js') !!}"></script>
    {!! Html::script( $pathp.'assets/backend/porto-admin/javascripts/theme.js') !!}
    <script type="text/javascript">
        $('.jquery-form-tickets').ajaxForm({
              dataType : 'json',
              success: function(response) {
                  if(response.status == 'success'){
                      var title_not = 'Notification';
                      var type_not = 'success';
                      // $(":file").filestyle('clear');
                      $(".btn.btn-default .badge").remove();
                  }else{
                      var title_not = 'Notification';
                      var type_not = 'failed';
                  }
                  $('#loader').addClass("hidden");
                  $("[name='email']").val('');
                  var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
                  new PNotify({
                      title: response.status,
                      text: response.notification,
                      type: type_not,
                      addclass: "stack-custom",
                      stack: myStack
                  });
              },
              beforeSend: function() {
                $('.has-error').html('');
              },
              error: function(response){
                if (response.status === 422) {
                    var data = response.responseJSON;
                    $.each(data,function(key,val){
                        $('.error-'+key).html(val);
                        $('#content').html(val);
                    });
                  // $("#modalFormTicket").scrollTop(0);
                  $('#loader').addClass("hidden");
                  var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
                  new PNotify({
                      title: "Failed",
                      text: "Validate Error, Check Your Data Again",
                      type: 'danger',
                      addclass: "stack-custom",
                      stack: myStack
                  });
                } else {
                    $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
                }
              }
          });
      </script>
@endsection