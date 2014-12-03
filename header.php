<?php
/**
 * @package Thuriot.be
 * @subpackage Thuriot.be_Theme
 */

$theme_options = get_option('thuriot_theme');
$stylesheet = get_stylesheet_directory_uri() . "/";

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">    
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <title><?php wp_title('&raquo;', true, 'right'); bloginfo('name'); ?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="language" content="en" />
    <meta name="description" content="<?php 
    
    if ( is_single() ) {
      single_post_title('', true); 
    } else {
      ?>Steven Thuriot is a <?

      function getAge($birth_date){
        list($birth_year,$birth_month,$birth_day) = explode("-", $birth_date);
        $year_diff=date("Y")-$birth_year; $this_birthday=date("Y").$birth_month.$birth_day;
        $date=date("Ymd");

        if($this_birthday>$date){
        $year_diff--;
        }

        return $year_diff;
      }
      
      echo getAge("1987-02-23");

      ?> year old developer based in Belgium, interested in both web and application design.<?
    }
    ?>" />
    <meta name="keywords" content="Steven Thuriot, thuriot, Developer, Web Design, Development, Java, PHP, ASP.NET, .NET, C#, CSS" />  
    
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    
    <link rel="stylesheet" type="text/css" href="<?php  echo $stylesheet . "style.css" ?>" media="screen" />
      
    <script type="text/javascript">
    <!-- 
      function getBrowserWidth(){if(window.innerWidth){return window.innerWidth}else{if(document.documentElement&&document.documentElement.clientWidth!=0){return document.documentElement.clientWidth}else{if(document.body){return document.body.clientWidth}}}return 0}var $=document;var cssId='themeWidth';if(getBrowserWidth()<=1085){if(!$.getElementById(cssId)){var head=$.getElementsByTagName('head')[0];var link=$.createElement('link');link.id=cssId;link.rel='stylesheet';link.type='text/css';link.href='<? echo $stylesheet ?>narrow.css';link.media='screen';head.appendChild(link)}}
    -->
    </script>

    <!-- <link rel="stylesheet" type="text/css" href="<?php echo $stylesheet . "print.css"; ?>" media="print" /> -->
    
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
  /* We add some JavaScript to pages with the comment form
   * to support sites with threaded comments (when in use).
   */
  if ( is_singular() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );

  /* Always have wp_head() just before the closing </head>
   * tag of your theme, or you will break many plugins, which
   * generally use this hook to add elements to <head> such
   * as styles, scripts, and meta tags.
   */
  wp_head();
?>
</head>
<body <?php body_class(); ?>>
    <div id="repeater-left"></div>
    <div id="repeater-right"></div>
    <div id="repeater-shade"></div>

    <div id="Container">
      <div id="header"></div>
      <div id="left-shade"></div>
      <div id="left-menu"></div>

      <div id="Button-1">
        <a href='/'></a>
      </div>

      <div id="Button-2">
        <a href="/<?php echo $theme_options["button_2_link"]; ?>"></a>
      </div>

      <div id="Button-3">
        <a href="/<?php echo $theme_options["button_3_link"]; ?>"></a>
      </div>

      <div id="Button-4">
        <a href="/<?php echo $theme_options["button_4_link"]; ?>"></a>
      </div>

      <div id="right-menu"></div>
      <div id="right-shade"></div>
      <div id="text-container1">
        <div id="text-container2">
          <div id="textbox">

