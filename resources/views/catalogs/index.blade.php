@extends('layouts.main')
@section('pageTitle', $catalog->title)
@section('metaTitle', '')
@section('metaKeyword', 'скрапбукинг фётр фоамиран куклы-тильды картины фанера декупаж полимерная глина')
@section('content')
    @include('products.header')
    <style>
        .accordion dl,
        .accordion-list {
            margin-top: .5rem;
        /* border:1px solid #ddd; */
        &:after {
             content: "";
             display:block;
             height:1em;
             width:100%;
             background-color:darken(#38cc70, 10%);
         }
        }
        .accordion dd,
        .accordion__panel {
            /* background-color:#eee; */
            font-size:1em;
            line-height:1.5em;
        }
        .accordion p {
            padding:1em 2em 1em 2em;
        }

        .accordion {
            position:relative;
            /* background-color:#eee; */
        }
        .inner-item{
            width: 90%;
        }
        .inner-item2{
            width: 90%;
        }
        .inner-item > dt > a:focus, .inner-item > dt > a:hover {
            font-weight: bolder !important;
            box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 0.18), 0 4px 15px 0 rgba(0, 0, 0, 0.15) !important;
        }
        .inner-item2 > dt > a:focus, .inner-item > dt > a:hover {
            font-weight: bolder !important;
            box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 0.18), 0 4px 15px 0 rgba(0, 0, 0, 0.15) !important;
        }
        .accordionTitle.active{
            background: #33b5e5 !important;
        }
        .accordionTitle,
        .accordion__Heading {
            /* background-color:#38cc70;  */
            text-align:center;
            font-weight:700;
            padding: 5px;
            display:block;
            text-decoration:none;
            color:#fff;
            transition:background-color 0.5s ease-in-out;
            border-bottom:1px solid darken(#38cc70, 5%);
        &:before {
             content: "+";
             font-size:1.5em;
             line-height:0.5em;
             float:left;
             transition: transform 0.3s ease-in-out;
         }
        &:hover {
             background-color:darken(#38cc70, 10%);
         }
        }
        .accordionTitleActive,
        .accordionTitle.is-expanded {
            background-color:darken(#38cc70, 10%);
        &:before {

             transform:rotate(-225deg);
         }
        }
        .accordionItem {
            height:auto;
            overflow:hidden;
        //SHAME: magic number to allow the accordion to animate

        max-height:50em;
            transition:max-height 1s;

        @media screen and (min-width:48em) {
            max-height:15em;
            transition:max-height 0.5s
        }
        }

        .accordionItem.is-collapsed {
            max-height:0;
        }
        .no-js .accordionItem.is-collapsed {
            max-height: auto;
        }
        .animateIn {
            animation: accordionIn 0.45s normal ease-in-out both 1;
        }
        .animateOut {
            animation: accordionOut 0.45s alternate ease-in-out both 1;
        }
        @keyframes accordionIn {
            0% {
                opacity: 0;
                transform:scale(0.9) rotateX(-60deg);
                transform-origin: 50% 0;
            }
            100% {
                opacity:1;
                transform:scale(1);
            }
        }

        @keyframes accordionOut {
            0% {
                opacity: 1;
                transform:scale(1);
            }
            100% {
                opacity:0;
                transform:scale(0.9) rotateX(-60deg);
            }
        }
        .item-grid button[disabled].btn, .item-grid button[disabled].btn:hover, .item-grid button[disabled].btn:focus {
            box-shadow: initial;
        }
    </style>
    <div class="container-fluid">
        <div class="container">
            <div class="row" style="margin-top: 20px; margin-bottom: 20px;">
                <div class="col-md-3">
                    <div class="accordion">
                        <dt>
                            <a href="/products" aria-expanded="false" class=" btn accordionTitle btn-default"><span class="glyphicon glyphicon-triangle-left"></span> переглянути все</a>
                        </dt>
                        <p style="text-align: center; margin: 0px;">Інші каталоги:</p>

                        @foreach($lastGroups as $lastGroup)
                                <a href="/products/catalogs/{{$lastGroup->id}}" aria-expanded="false" class=" btn accordionTitle btn-default">{{$lastGroup->title}} <span class="glyphicon glyphicon-triangle-right"></span></a>
                        @endforeach

                    </div>
                </div>
                <div class="col-md-9">
                    @include('products.products_wraper')
                </div>
            </div>
        </div>
    </div>
@endsection


