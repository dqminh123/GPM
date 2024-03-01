@extends('layouts.frontend')
@section('main')
<br>
    <div class="main">
        <div class="container">
            
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN SIDEBAR -->
                <div class="sidebar col-md-3 col-sm-3 ">

                    <h2>Our Contacts</h2>
                    <address>
                        6 Lê Quát, Đông Xuyên, Long Xuyên, An Giang<br>
                        <abbr title="Phone">P:</abbr> 0902-777-186<br>
                    </address>
                    <address>
                        <strong>Email</strong><br>
                        <a href="mailto:info@metronic.com">dqminh_19pm@student.agu.edu.vn</a><br>
                        <a href="mailto:support@metronic.com">minhdanglxag1@gmail.com</a>
                    </address>
                    <ul class="social-icons margin-bottom-10">
                        <li><a href="javascript:;" data-original-title="facebook" class="facebook"></a></li>
                        <li><a href="javascript:;" data-original-title="github" class="github"></a></li>
                        <li><a href="javascript:;" data-original-title="Goole Plus" class="googleplus"></a></li>
                        <li><a href="javascript:;" data-original-title="linkedin" class="linkedin"></a></li>
                        <li><a href="javascript:;" data-original-title="rss" class="rss"></a></li>
                    </ul>
                </div>
                <div class="col-md-9 col-sm-9">
                    <div class="content-page text-black">
                        <h1>Liên Hệ</h1>
                        <p>Mọi thắc mắc xin liên hệ Shop chúng tôi , Shop chúng tôi sẽ trả lời những thắc mắc của bạn trong
                            vòng sớm nhất. Cảm ơn quý khách đã ghé thăm và ủng hộ Shop rất nhiều </p>

                       
                            <div class="section section_maps section margin-bottom-0">
                                <div class="box-maps">
                                    <div class="iFrameMap">
                                        <div class="google-map">
                                            <div id="contact_map" class="map">
                                                <iframe
                                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1962.285883469459!2d105.42629765799151!3d10.376084136496408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310a72c2de4e74d9%3A0xd7f006858cd8853e!2sC%C3%B4ng%20ty%20GPM!5e0!3m2!1svi!2sus!4v1627956541857!5m2!1svi!2sus"
                                                    width="600" height="450" style="border:0;" allowfullscreen=""
                                                    loading="lazy"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       
                        <!-- BEGIN FORM-->
                        <form action="#" class="default-form" role="form">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span class="require">*</span></label>
                                <input type="text" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" rows="8" id="message"></textarea>
                            </div>
                            <div class="padding-top-20">
                                <button type="submit" class="btn btn-danger">Submit</button>
                            </div>
                        </form>
                        <br>
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
@endsection
