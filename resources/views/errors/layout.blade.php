<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="/favicon.ico">
        <title>
            @yield('title') | Swagat Hospital Admin Panel
        </title>

        <!-- Core CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    
    </head>
	<body>
		<!-- App Start-->
		<div id="root">
			<!-- App Layout-->
			<div class="app-layout-classic flex flex-auto flex-col">
				<div class="flex flex-auto min-w-0">

					<!-- Header Nav start-->
					<div class="flex flex-col flex-auto min-h-screen min-w-0 relative w-full">
						<!-- Popup end-->
						<div class="h-full flex flex-auto flex-col justify-between">
							<!-- Content start -->
							<main class="h-full">
								<div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
                                    <div class="container mx-auto h-full">
                                        <div class="h-full flex flex-col items-center justify-center">
                                            <img src="{{ asset('assets/img/others/img-2.png') }}" alt="@yield('title')">
                                            <div class="mt-6 text-center">
                                                @yield('message')
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</main>
							<!-- Content end -->
							@include('layout.footer.footer')
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>