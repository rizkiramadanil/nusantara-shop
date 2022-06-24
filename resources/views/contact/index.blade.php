@extends('layouts.main')

@section('main-body')
    <div class="page-heading contact-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>contact us</h4>
              <h2>Nusantara Shop</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="find-us">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Our Location on Maps</h2>
            </div>
          </div>
          <div class="col-md-8">
            <div id="map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.304543353077!2d100.39518411551607!3d-0.9195027993292257!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b85782da68cb%3A0x15080dcf0408ee3d!2sJl.%20Raya%20Cengkeh%2C%20Korong%20Gadang%2C%20Kec.%20Kuranji%2C%20Kota%20Padang%2C%20Sumatera%20Barat%2025175!5e0!3m2!1sid!2sid!4v1643336486764!5m2!1sid!2sid" width="100%" height="330px" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
          </div>
          <div class="col-md-4">
            <div class="left-content">
              <h4>About our office</h4>
              <p>Nusantara shop merupakan aplikasi web yang dibuat untuk memenuhi tugas project pada mata kuliah Project 2 (Web Information System). Oleh karena itu, Nusantara Shop tidak memiliki kantor ataupun lokasi yang nyata. Untuk map sendiri merupakan lokasi yang kami tentukan secara acak.</p>
              <ul class="social-icons">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="send-message">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Send us a Message</h2>
            </div>
          </div>
          <div class="col-md-8">
            <div class="contact-form">
              <form method="post" action="/contact" class="mb-5" enctype="multipart/form-data">
                @csrf
                <div>
                  <input type="text" class="form-control @error ('name') is-invalid @enderror" id="name" name="name" required placeholder="Name" value="{{ old('name') }}">
                </div>
                <div>
                  <input type="text" class="form-control @error ('email') is-invalid @enderror" id="email" name="email" required placeholder="Email" value="{{ old('email') }}">
                </div>
                <div>
                  <input type="text" class="form-control @error ('subject') is-invalid @enderror" id="subject" name="subject" required placeholder="Subject" value="{{ old('subject') }}">
                </div>
                <div>
                  <textarea rows="6" class="form-control @error ('body') is-invalid @enderror" id="body" name="body" required placeholder="Your Message">{{ old('body') }}</textarea>
                </div>
                <button type="submit" class="btn btn-main">Send Message</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection