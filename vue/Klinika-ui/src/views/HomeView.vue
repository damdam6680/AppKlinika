<script setup>
import {ref, onMounted} from 'vue'
import axios from 'axios';

const user = ref();

onMounted(async () =>{
    const data = await axios.get('http://127.0.0.1:8000/api/user');
    console.log(data);
})


</script>

<template>
  <main>

    <header>
        <nav class="bg-white border-gray-200 dark:bg-gray-900">
          <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
          <a href="https://flowbite.com/" class="flex items-center">
              <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="Flowbite Logo" />
              <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
          </a>
          <div class="flex md:order-2">
              <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><a href="/login">Login</a></button>
              <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-3">Sing up</button>
              <button data-collapse-toggle="navbar-cta" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-cta" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            </button>
          </div>
          <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
            <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
              <li>
                <a href="#" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>
              </li>
              <li>
                <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
              </li>
              <li>
                <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Services</a>
              </li>
              <li>
                <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
              </li>
            </ul>
          </div>
          </div>
        </nav>
  </header>

    <!-- start hero -->
    <div class="bg-gray-100">
      <section class="cover bg-blue-teal-gradient relative bg-blue-600 px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 overflow-hidden py-48 flex
      items-center min-h-screen">
        <div class="h-full absolute top-0 left-0 z-0">
          <img src="images/cover-bg.jpg" alt="" class="w-full h-full object-cover opacity-20">
        </div>

        <div class="lg:w-3/4 xl:w-2/4 relative z-10 h-100 lg:mt-16">
          <div>
            <h1 class="text-white text-4xl md:text-5xl xl:text-6xl font-bold leading-tight">A better life starts with a
              beautiful
              smile.</h1>
            <p class="text-blue-100 text-xl md:text-2xl leading-snug mt-4">Welcome to the Dentist Office of Dr. Thomas
              Dooley,
              where
              trust
              and comfort are priorities.</p>
            <a href="#" class="px-8 py-4 bg-teal-500 text-white rounded inline-block mt-8 font-semibold">Book
              Appointment</a>
          </div>
        </div>
      </section>
    </div>
    <!-- end hero -->

    <!-- start about -->
    <section class="relative px-4 py-16 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 lg:py-32">
      <div class="flex flex-col lg:flex-row lg:-mx-8">
        <div class="w-full lg:w-1/2 lg:px-8">
          <h2 class="text-3xl leading-tight font-bold mt-4">Welcome to the Dentist Office of Dr. Thomas Dooley</h2>
          <p class="text-lg mt-4 font-semibold">Excellence in Dentistry in the Heart of NY</p>
          <p class="mt-2 leading-relaxed">Donec convallis sollicitudin facilisis. Integer nisl ligula, accumsan non
            tincidunt ac, imperdiet in enim.
            Donec efficitur ullamcorper metus, eu venenatis nunc. Nam eget neque tempus, mollis sem a, faucibus mi.</p>
        </div>

        <div class="w-full lg:w-1/2 lg:px-8 mt-12 lg:mt-0">
          <div class="md:flex">
            <div>
              <div class="w-16 h-16 bg-blue-600 rounded-full"></div>
            </div>
            <div class="md:ml-8 mt-4 md:mt-0">
              <h4 class="text-xl font-bold leading-tight">Everything You Need Under One Roof</h4>
              <p class="mt-2 leading-relaxed">Our comprehensive services allow you to receive all needed dental care
                right here in our state-of-art
                office – from dental cleanings and fillings to dental implants and extractions.</p>
            </div>
          </div>

          <div class="md:flex mt-8">
            <div>
              <div class="w-16 h-16 bg-blue-600 rounded-full"></div>
            </div>
            <div class="md:ml-8 mt-4 md:mt-0">
              <h4 class="text-xl font-bold leading-tight">Our Patient-Focused Approach</h4>
              <p class="mt-2 leading-relaxed">Your treatment plan will perfectly match your needs, lifestyle, and goals.
                Even if it’s been years
                since you last visited the dentist, we can help. Our comfortable office, compassionate team, and
                minimally-invasive treatments will help you feel completely at ease.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="md:flex md:flex-wrap mt-24 text-center md:-mx-4">
        <div class="md:w-1/2 md:px-4 lg:w-1/4">
          <div class="bg-white rounded-lg border border-gray-300 p-8">
            <img src="images/teeth-whitening.svg" alt="" class="h-20 mx-auto">

            <h4 class="text-xl font-bold mt-4">Teeth Whitening</h4>
            <p class="mt-1">Let us show you how our experience.</p>
            <a href="#" class="block mt-4">Read More</a>
          </div>
        </div>

        <div class="md:w-1/2 md:px-4 mt-4 md:mt-0 lg:w-1/4">
          <div class="bg-white rounded-lg border border-gray-300 p-8">
            <img src="images/oral-surgery.svg" alt="" class="h-20 mx-auto">

            <h4 class="text-xl font-bold mt-4">Oral Surgery</h4>
            <p class="mt-1">Let us show you how our experience.</p>
            <a href="#" class="block mt-4">Read More</a>
          </div>
        </div>

        <div class="md:w-1/2 md:px-4 mt-4 md:mt-8 lg:mt-0 lg:w-1/4">
          <div class="bg-white rounded-lg border border-gray-300 p-8">
            <img src="images/painless-dentistry.svg" alt="" class="h-20 mx-auto">

            <h4 class="text-xl font-bold mt-4">Painless Dentistry</h4>
            <p class="mt-1">Let us show you how our experience.</p>
            <a href="#" class="block mt-4">Read More</a>
          </div>
        </div>

        <div class="md:w-1/2 md:px-4 mt-4 md:mt-8 lg:mt-0 lg:w-1/4">
          <div class="bg-white rounded-lg border border-gray-300 p-8">
            <img src="images/periodontics.svg" alt="" class="h-20 mx-auto">

            <h4 class="text-xl font-bold mt-4">Periodontics</h4>
            <p class="mt-1">Let us show you how our experience.</p>
            <a href="#" class="block mt-4">Read More</a>
          </div>
        </div>
      </div>
    </section>
    <!-- end about -->

    <!-- start testimonials -->
    <section class="relative bg-gray-100 px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 py-16 lg:py-32">
      <div class="flex flex-col lg:flex-row lg:-mx-8">
        <div class="w-full lg:w-1/2 lg:px-8">
          <h2 class="text-3xl leading-tight font-bold mt-4">Why choose the Mesothelioma Center?</h2>
          <p class="mt-2 leading-relaxed">Aenean ut tellus tellus. Suspendisse potenti. Nullam tincidunt lacus tellus,
            sed aliquam est vehicula a. Pellentesque consectetur condimentum nulla, eleifend condimentum purus vehicula
            in. Donec convallis sollicitudin facilisis. Integer nisl ligula, accumsan non tincidunt ac, imperdiet in
            enim. Donec efficitur ullamcorper metus, eu venenatis nunc. Nam eget neque tempus, mollis sem a, faucibus
            mi.</p>
        </div>

        <div class="w-full md:max-w-md md:mx-auto lg:w-1/2 lg:px-8 mt-12 mt:md-0">
          <div class="bg-gray-400 w-full h-72 rounded-lg"></div>

          <p class="italic text-sm mt-2 text-center">Aenean ante nisi, gravida non mattis semper.</p>
        </div>
      </div>
    </section>
    <!-- end testimonials -->

    <!-- start blog -->
    <section class="relative bg-white px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 py-32">
      <div class="">
        <h2 class="text-3xl leading-tight font-bold">Health Blog</h2>
        <p class="text-gray-600 mt-2 md:max-w-lg">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac
          turpis egestas.</p>

        <a href="#" title="" class="inline-block text-teal-500 font-semibold mt-6 mt:md-0">View All Posts</a>
      </div>

      <div class="md:flex mt-12 md:-mx-4">
        <div class="md:px-4 md:w-1/2 xl:w-1/4">
          <div class="bg-white rounded border border-gray-300">
            <div class="w-full h-48 overflow-hidden bg-gray-300"></div>
            <div class="p-4">
              <div class="flex items-center text-sm">
                <span class="text-teal-500 font-semibold">Business</span>
                <span class="ml-4 text-gray-600">29 Nov, 2019</span>
              </div>
              <p class="text-lg font-semibold leading-tight mt-4">Card Title</p>
              <p class="text-gray-600 mt-1">This card has supporting text below as a natural lead-in to additional content.
              </p>
              <div class="flex items-center mt-4">
                <div class="w-8 h-8 rounded-full overflow-hidden bg-gray-300"></div>
                <div class="ml-4">
                  <p class="text-gray-600">By <span class="text-gray-900 font-semibold">Abby Sims</span></p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="md:px-4 md:w-1/2 xl:w-1/4 mt-4 md:mt-0">
          <div class="bg-white rounded border border-gray-300 ">
            <div class="w-full h-48 overflow-hidden bg-gray-300"></div>
            <div class="p-4">
              <div class="flex items-center text-sm">
                <span class="text-teal-500 font-semibold">Business</span>
                <span class="ml-4 text-gray-600">29 Nov, 2019</span>
              </div>
              <p class="text-lg font-semibold leading-tight mt-4">Card Title</p>
              <p class="text-gray-600 mt-1">This card has supporting text below as a natural lead-in to additional
                content.
              </p>
              <div class="flex items-center mt-4">
                <div class="w-8 h-8 rounded-full overflow-hidden bg-gray-300"></div>
                <div class="ml-4">
                  <p class="text-gray-600">By <span class="text-gray-900 font-semibold">Abby Sims</span></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end blog -->

    <!-- start cta -->
    <section
      class="relative bg-blue-teal-gradient px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 py-12 text-center md:text-left">
      <div class="md:flex md:items-center md:justify-center">
        <h2 class="text-xl font-bold text-white">Get in touch with us today! <br class="block md:hidden">Call us on: +1
          562-789-1935</h2>
        <a href="#"
          class="px-8 py-4 bg-white text-blue-600 rounded inline-block font-semibold md:ml-8 mt-4 md:mt-0">Book
          Appointment</a>
      </div>
    </section>
    <!-- end cta -->


  </main>
</template>
