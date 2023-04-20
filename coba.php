<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>profile about info</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- add styles css -->
    <link href="assets/css/styles.css" rel="stylesheet">

</head>
<div class="profile-header">
        <div class="profile-header-cover"></div>

        <div class="profile-header-content">
            <div class="profile-header-img">
                <img src="ajax/inventory/uploads/6554Kirato Original.jpg" alt="" />
            </div>

            <div class="profile-header-info">
                <h4 class="m-t-sm">SOENG SOUY</h4>
                <p class="m-b-sm">UX UI + Frontend Developer</p>
                <a href="#" class="btn btn-xs btn-primary mb-3">Edit Profile</a>
            </div>
        </div>
    </div>
<!-- <script>Library</script> -->
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
</script>

</body>
</html>

<style>
  body {
    background: #eaeaea;
    margin-top: 20px;
  }
  
  .profile-info-list {
    padding: 0;
    margin: 0;
    list-style-type: none;
  }
  
  .friend-list,
  .img-grid-list {
    margin: -1px;
    list-style-type: none;
  }
  
  .profile-info-list > li.title {
    font-size: 0.625rem;
    font-weight: 700;
    color: #8a8a8f;
    padding: 0 0 0.3125rem;
  }
  
  .profile-info-list > li + li.title {
    padding-top: 1.5625rem;
  }
  
  .profile-info-list > li {
    padding: 0.625rem 0;
  }
  
  .profile-info-list > li .field {
    font-weight: 700;
  }
  
  .profile-info-list > li .value {
    color: #666;
  }
  
  .profile-info-list > li.img-list a {
    display: inline-block;
  }
  
  .profile-info-list > li.img-list a img {
    max-width: 2.25rem;
    -webkit-border-radius: 2.5rem;
    -moz-border-radius: 2.5rem;
    border-radius: 2.5rem;
  }
  
  .coming-soon-cover img,
  .email-detail-attachment .email-attachment .document-file img,
  .email-sender-img img,
  .friend-list .friend-img img,
  .profile-header-img img {
    max-width: 10%;
  }
  
  .table.table-profile th {
    border: none;
    color: #000;
    padding-bottom: 0.3125rem;
    padding-top: 0;
  }
  
  .table.table-profile td {
    border-color: #c8c7cc;
  }
  
  .table.table-profile tbody + thead > tr > th {
    padding-top: 1.5625rem;
  }
  
  .table.table-profile .field {
    color: #666;
    font-weight: 600;
    width: 25%;
    text-align: right;
  }
  
  .table.table-profile .value {
    font-weight: 500;
  }
  
  .profile-header {
    position: relative;
    overflow: hidden;
  }
  
  .profile-header .profile-header-cover {
    background: url("ajax/inventory/uploads/6554Kirato Original.jpg") center no-repeat;
    background-size: 100% auto;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
  }
  
  .profile-header .profile-header-cover:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.25) 0, rgba(0, 0, 0, 0.85) 100%);
  }
  
  .profile-header .profile-header-content,
  .profile-header .profile-header-tab,
  .profile-header-img,
  body .fc-icon {
    position: relative;
  }
  
  .profile-header .profile-header-tab {
    background: #fff;
    list-style-type: none;
    margin: -1.25rem 0 0;
    padding: 0 0 0 8.75rem;
    border-bottom: 1px solid #c8c7cc;
    white-space: nowrap;
  }
  
  .profile-header .profile-header-tab > li {
    display: inline-block;
    margin: 0;
  }
  
  .profile-header .profile-header-tab > li > a {
    display: block;
    color: #000;
    line-height: 1.25rem;
    padding: 0.625rem 1.25rem;
    text-decoration: none;
    font-weight: 700;
    font-size: 0.75rem;
    border: none;
  }
  
  .profile-header .profile-header-tab > li.active > a,
  .profile-header .profile-header-tab > li > a.active {
    color: #007aff;
  }
  
  .profile-header .profile-header-content:after,
  .profile-header .profile-header-content:before {
    content: "";
    display: table;
    clear: both;
  }
  
  .profile-header .profile-header-content {
    color: #fff;
    padding: 1.25rem;
  }
  
  body .fc th a,
  body .fc-ltr .fc-basic-view .fc-day-top .fc-day-number,
  body .fc-widget-header a {
    color: #000;
  }
  
  .profile-header-img {
    float: left;
    width: 7.5rem;
    overflow: hidden;
    z-index: 10;
    margin: 0 1.25rem -1.25rem 0;
    padding: 0.1875rem;
    -webkit-border-radius: 0.25rem;
    -moz-border-radius: 0.25rem;
    background: rgb(209, 198, 198);
    border-radius: 50%;
    border: 1px solid #01a9ac;
    padding: 4px;
    
  }
  
  .profile-header-info h4 {
    font-weight: 500;
    margin-bottom: 0.3125rem;
  }
  
  .profile-container {
    padding: 1.5625rem;
  }
  
  @media (max-width: 967px) {
    .profile-header-img {
      width: 5.625rem;
      height: 5.625rem;
      margin: 0;
    }
  
    .profile-header-info {
      margin-left: 6.5625rem;
      padding-bottom: 0.9375rem;
    }
  
    .profile-header .profile-header-tab {
      padding-left: 0;
    }
  }
  @media (max-width: 767px) {
    .profile-header .profile-header-cover {
      background-position: top;
    }
  
    .profile-header-img {
      width: 3.75rem;
      height: 3.75rem;
      margin: 0;
    }
  
    .profile-header-info {
      margin-left: 4.6875rem;
      padding-bottom: 0.9375rem;
    }
  
    .profile-header-info h4 {
      margin: 0 0 0.3125rem;
    }
  
    .profile-header .profile-header-tab {
      white-space: nowrap;
      overflow: scroll;
      padding: 0;
    }
  
    .profile-container {
      padding: 0.9375rem 0.9375rem 3.6875rem;
    }
  
    .friend-list > li {
      float: none;
      width: auto;
    }
  }
  .profile-info-list {
    padding: 0;
    margin: 0;
    list-style-type: none;
  }
  
  .friend-list,
  .img-grid-list {
    margin: -1px;
    list-style-type: none;
  }
  
  .profile-info-list > li.title {
    font-size: 0.625rem;
    font-weight: 700;
    color: #8a8a8f;
    padding: 0 0 0.3125rem;
  }
  
  .profile-info-list > li + li.title {
    padding-top: 1.5625rem;
  }
  
  .profile-info-list > li {
    padding: 0.625rem 0;
  }
  
  .profile-info-list > li .field {
    font-weight: 700;
  }
  
  .profile-info-list > li .value {
    color: #666;
  }
  
  .profile-info-list > li.img-list a {
    display: inline-block;
  }
  
  .profile-info-list > li.img-list a img {
    max-width: 2.25rem;
    -webkit-border-radius: 2.5rem;
    -moz-border-radius: 2.5rem;
    border-radius: 2.5rem;
  }
  
  .coming-soon-cover img,
  .email-detail-attachment .email-attachment .document-file img,
  .email-sender-img img,
  .friend-list .friend-img img,
  .profile-header-img img {
    max-width: 100%;
  }
  
  .table.table-profile th {
    border: none;
    color: #000;
    padding-bottom: 0.3125rem;
    padding-top: 0;
    background-image: linear-gradient(315deg, #63a4ff 0%, #83eaf1 74%);
  }
  
  .table.table-profile td {
    border-color: #c8c7cc;
  }
  
  .table.table-profile tbody + thead > tr > th {
    padding-top: 1.5625rem;
  }
  
  .table.table-profile .field {
    color: #666;
    font-weight: 600;
    width: 25%;
    text-align: right;
  }
  
  .table.table-profile .value {
    font-weight: 500;
  }
  
  .friend-list {
    padding: 0;
  }
  
  .friend-list > li {
    float: left;
    width: 50%;
  }
  
  .friend-list > li > a {
    display: block;
    text-decoration: none;
    color: #000;
    padding: 0.625rem;
    margin: 1px;
    background: #fff;
  }
  
  .friend-list > li > a:after,
  .friend-list > li > a:before {
    content: "";
    display: table;
    clear: both;
  }
  
  .friend-list .friend-img {
    float: left;
    width: 3rem;
    height: 3rem;
    overflow: hidden;
    background: #efeff4;
  }
  
  .friend-list .friend-info {
    margin-left: 3.625rem;
  }
  
  .friend-list .friend-info h4 {
    margin: 0.3125rem 0;
    font-size: 0.875rem;
    font-weight: 600;
  }
  
  .friend-list .friend-info p {
    color: #666;
    margin: 0;
  }
</style>