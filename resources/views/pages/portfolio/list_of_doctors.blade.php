@extends('layout.main')
@section('title', "List of Doctors'")
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class=" mb-4">
                <h3>List of Doctor's</h3>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4 mb-6">
                <div class="card card-border">
                    <div class="card-body">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-4">
                                <span class="avatar avatar-rounded !bg-indigo-600 text-2xl" data-avatar-size="55">
                                    <span class="avatar-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" height="1em" width="1em">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>                                          
                                    </span>
                                </span>
                                <div>
                                    <span>Total Doctors'</span>
                                    <h3>
                                        <span>2,420</span>
                                    </h3>
                                </div>
                            </div>
                            {{-- <div class="tag gap-1 font-bold border-0 text-emerald-600 dark:text-emerald-400 bg-emerald-100 dark:bg-emerald-500/20">
                                <span>
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20"
                                        aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                                                         
                                </span>
                                <span>17.2%</span>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="card card-border">
                    <div class="card-body">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-4">
                                <span class="avatar avatar-rounded !bg-emerald-500 text-2xl" data-avatar-size="55">
                                    <span class="avatar-icon">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                        </svg> 
                                    </span>
                                </span>
                                <div>
                                    <span>Linked Departments</span>
                                    <h3>
                                        <span>1,897</span>
                                    </h3>
                                </div>
                            </div>
                            {{-- <div class="tag gap-1 font-bold border-0 text-emerald-600 dark:text-emerald-400 bg-emerald-100 dark:bg-emerald-500/20">
                                <span>
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20"
                                        aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <span>32.7%</span>
                            </div> --}}
                        </div>
                    </div>
                </div>
                {{-- <div class="card card-border" role="presentation">
                    <div class="card-body">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-4">
                                <span class="avatar avatar-rounded !bg-emerald-500 text-2xl" data-avatar-size="55">
                                    <span class="avatar-icon">
                                        <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                                            aria-hidden="true" height="1em" width="1em"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                            </path>
                                        </svg>
                                    </span>
                                </span>
                                <div>
                                    <span>New Customers</span>
                                    <h3>
                                        <span>241</span>
                                    </h3>
                                </div>
                            </div>
                            <div
                                class="tag gap-1 font-bold border-0 text-red-600 dark:text-red-500 bg-red-100 dark:bg-red-500/20">
                                <span>
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20"
                                        aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <span>-2.3%</span>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="card adaptable-card">
                <div class="card-body">
                    <table id="customers-data-table" class="table-default table-hover data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Last Online</th>
                                <th></th>
                            </tr>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="flex items-center"><span class="avatar avatar-circle w-[28px]"
                                            data-avatar-size="28">
                                            <img class="avatar-img avatar-circle" src="img/avatars/thumb-1.jpg"
                                                loading="lazy"></span>
                                        <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold"href="#?id=1">Carolyn
                                            Perkins</a>
                                    </div>
                                </td>
                                <td>carolyn_h@hotmail.com</td>
                                <td>
                                    <div class="flex items-center">
                                        <span class="badge-dot bg-emerald-500"></span>
                                        <span class="ml-2 rtl:mr-2 capitalize">active</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center">06/12/2021</div>
                                </td>
                                <td>
                                    <div class="text-primary-600 cursor-pointer select-none font-semibold">Edit</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <span class="avatar avatar-circle w-[28px]" data-avatar-size="28">
                                            <img class="avatar-img avatar-circle" src="img/avatars/thumb-2.jpg"
                                                loading="lazy">
                                        </span>
                                        <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold"
                                            href="#?id=2">Terrance Moreno</a>
                                    </div>
                                </td>
                                <td>terrance_moreno@infotech.io</td>
                                <td>
                                    <div class="flex items-center">
                                        <span class="badge-dot bg-emerald-500"></span>
                                        <span class="ml-2 rtl:mr-2 capitalize">active</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center">09/23/2021</div>
                                </td>
                                <td>
                                    <div class="text-primary-600 cursor-pointer select-none font-semibold">Edit</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <span class="avatar avatar-circle w-[28px]" data-avatar-size="28">
                                            <img class="avatar-img avatar-circle" src="img/avatars/thumb-3.jpg"
                                                loading="lazy">
                                        </span>
                                        <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold" href="#?id=3">
                                            Ron Vargas
                                        </a>
                                    </div>
                                </td>
                                <td>ronnie_vergas@infotech.io</td>
                                <td>
                                    <div class="flex items-center">
                                        <span class="badge-dot bg-red-500"></span>
                                        <span class="ml-2 rtl:mr-2 capitalize">blocked</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center">09/23/2021</div>
                                </td>
                                <td>
                                    <div class="text-primary-600 cursor-pointer select-none font-semibold">Edit</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <span class="avatar avatar-circle w-[28px]" data-avatar-size="28">
                                            <img class="avatar-img avatar-circle" src="img/avatars/thumb-4.jpg"
                                                loading="lazy">
                                        </span>
                                        <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold" href="#?id=4">Luke
                                            Cook</a>
                                    </div>
                                </td>
                                <td>cookie_lukie@hotmail.com</td>
                                <td>
                                    <div class="flex items-center">
                                        <span class="badge-dot bg-emerald-500"></span>
                                        <span class="ml-2 rtl:mr-2 capitalize">active</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center">12/10/2021</div>
                                </td>
                                <td>
                                    <div class="text-primary-600 cursor-pointer select-none font-semibold">Edit</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <span class="avatar avatar-circle w-[28px]" data-avatar-size="28">
                                            <img class="avatar-img avatar-circle" src="img/avatars/thumb-5.jpg"
                                                loading="lazy">
                                        </span>
                                        <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold" href="#?id=5">Joyce
                                            Freeman</a>
                                    </div>
                                </td>
                                <td>joyce991@infotech.io</td>
                                <td>
                                    <div class="flex items-center">
                                        <span class="badge-dot bg-emerald-500"></span>
                                        <span class="ml-2 rtl:mr-2 capitalize">active</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center">09/24/2021</div>
                                </td>
                                <td>
                                    <div class="text-primary-600 cursor-pointer select-none font-semibold">Edit</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <span class="avatar avatar-circle w-[28px]" data-avatar-size="28">
                                            <img class="avatar-img avatar-circle" src="img/avatars/thumb-6.jpg"
                                                loading="lazy">
                                        </span>
                                        <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold"
                                            href="#?id=6">Samantha Phillips</a>
                                    </div>
                                </td>
                                <td>samanthaphil@infotech.io</td>
                                <td>
                                    <div class="flex items-center"><span class="badge-dot bg-emerald-500"></span>
                                        <span class="ml-2 rtl:mr-2 capitalize">active</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center">10/02/2021</div>
                                </td>
                                <td>
                                    <div class="text-primary-600 cursor-pointer select-none font-semibold">Edit</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <span class="avatar avatar-circle w-[28px]" data-avatar-size="28">
                                            <img class="avatar-img avatar-circle" src="img/avatars/thumb-7.jpg"
                                                loading="lazy">
                                        </span>
                                        <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold" href="#?id=7">
                                            Tara Fletcher
                                        </a>
                                    </div>
                                </td>
                                <td>taratarara@imaze.edu.du</td>
                                <td>
                                    <div class="flex items-center">
                                        <span class="badge-dot bg-emerald-500"></span>
                                        <span class="ml-2 rtl:mr-2 capitalize">active</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center">09/28/2021</div>
                                </td>
                                <td>
                                    <div class="text-primary-600 cursor-pointer select-none font-semibold">Edit</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <span class="avatar avatar-circle w-[28px]" data-avatar-size="28">
                                            <img class="avatar-img avatar-circle" src="img/avatars/thumb-8.jpg"
                                                loading="lazy">
                                        </span>
                                        <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold"
                                            href="#?id=8">Frederick Adams</a>
                                    </div>
                                </td>
                                <td>iamfred@imaze.infotech.io</td>
                                <td>
                                    <div class="flex items-center">
                                        <span class="badge-dot bg-red-500"></span>
                                        <span class="ml-2 rtl:mr-2 capitalize">blocked</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center">12/11/2021</div>
                                </td>
                                <td>
                                    <div class="text-primary-600 cursor-pointer select-none font-semibold">Edit</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <span class="avatar avatar-circle w-[28px]" data-avatar-size="28">
                                            <img class="avatar-img avatar-circle" src="img/avatars/thumb-9.jpg"
                                                loading="lazy">
                                        </span>
                                        <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold"
                                            href="#?id=9">Carolyn Hanson</a>
                                    </div>
                                </td>
                                <td>carolyn_h@gmail.com</td>
                                <td>
                                    <div class="flex items-center">
                                        <span class="badge-dot bg-red-500"></span>
                                        <span class="ml-2 rtl:mr-2 capitalize">blocked</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center">10/18/2021</div>
                                </td>
                                <td>
                                    <div class="text-primary-600 cursor-pointer select-none font-semibold">Edit</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <span class="avatar avatar-circle w-[28px]" data-avatar-size="28">
                                            <img class="avatar-img avatar-circle" src="img/avatars/thumb-10.jpg"
                                                loading="lazy">
                                        </span>
                                        <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold"
                                            href="#?id=10">Brittany Hale</a>
                                    </div>
                                </td>
                                <td>brittany1134@gmail.com</td>
                                <td>
                                    <div class="flex items-center">
                                        <span class="badge-dot bg-emerald-500"></span>
                                        <span class="ml-2 rtl:mr-2 capitalize">active</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center">10/06/2021</div>
                                </td>
                                <td>
                                    <div class="text-primary-600 cursor-pointer select-none font-semibold">Edit</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <span class="avatar avatar-circle w-[28px]" data-avatar-size="28">
                                            <img class="avatar-img avatar-circle" src="img/avatars/thumb-11.jpg"
                                                loading="lazy">
                                        </span>
                                        <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold"href="#">Lloyd
                                            Obrien</a>
                                    </div>
                                </td>
                                <td>handsome-obrien@hotmail.com</td>
                                <td>
                                    <div class="flex items-center">
                                        <span class="badge-dot bg-emerald-500"></span>
                                        <span class="ml-2 rtl:mr-2 capitalize">active</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center">10/19/2021</div>
                                </td>
                                <td>
                                    <div class="text-primary-600 cursor-pointer select-none font-semibold">Edit</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <span class="avatar avatar-circle w-[28px]" data-avatar-size="28">
                                            <img class="avatar-img avatar-circle" src="img/avatars/thumb-12.jpg"
                                                loading="lazy">
                                        </span>
                                        <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold"href="#">Gabriella
                                            May</a>
                                    </div>
                                </td>
                                <td>maymaymay12@infotech.io</td>
                                <td>
                                    <div class="flex items-center">
                                        <span class="badge-dot bg-red-500"></span>
                                        <span class="ml-2 rtl:mr-2 capitalize">blocked</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center">10/14/2021</div>
                                </td>
                                <td>
                                    <div class="text-primary-600 cursor-pointer select-none font-semibold">Edit</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <span class="avatar avatar-circle w-[28px]" data-avatar-size="28">
                                            <img class="avatar-img avatar-circle" src="img/avatars/thumb-13.jpg"
                                                loading="lazy">
                                        </span>
                                        <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold"href="#">Lee
                                            Wheeler</a>
                                    </div>
                                </td>
                                <td>lee_wheeler@infotech.io</td>
                                <td>
                                    <div class="flex items-center">
                                        <span class="badge-dot bg-emerald-500"></span>
                                        <span class="ml-2 rtl:mr-2 capitalize">active</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center">11/12/2021</div>
                                </td>
                                <td>
                                    <div class="text-primary-600 cursor-pointer select-none font-semibold">Edit</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <span class="avatar avatar-circle w-[28px]" data-avatar-size="28">
                                            <img class="avatar-img avatar-circle" src="img/avatars/thumb-14.jpg"
                                                loading="lazy">
                                        </span>
                                        <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold"href="#">Gail
                                            Barnes</a>
                                    </div>
                                </td>
                                <td>gailby0116@infotech.io</td>
                                <td>
                                    <div class="flex items-center">
                                        <span class="badge-dot bg-emerald-500"></span>
                                        <span class="ml-2 rtl:mr-2 capitalize">active</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center">10/01/2021</div>
                                </td>
                                <td>
                                    <div class="text-primary-600 cursor-pointer select-none font-semibold">Edit</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <span class="avatar avatar-circle w-[28px]" data-avatar-size="28">
                                            <img class="avatar-img avatar-circle" src="img/avatars/thumb-15.jpg"
                                                loading="lazy">
                                        </span>
                                        <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold"href="#">Ella
                                            Robinson</a>
                                    </div>
                                </td>
                                <td>ella_robinson@infotech.io</td>
                                <td>
                                    <div class="flex items-center">
                                        <span class="badge-dot bg-emerald-500"></span>
                                        <span class="ml-2 rtl:mr-2 capitalize">active</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center">11/07/2021</div>
                                </td>
                                <td>
                                    <div class="text-primary-600 cursor-pointer select-none font-semibold">Edit</div>
                                </td>
                            </tr>
                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
@endsection
