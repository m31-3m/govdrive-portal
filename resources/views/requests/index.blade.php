<x-app-layout>
    <style>
        .mesh-gradient { 
            background-image: radial-gradient(at 0% 0%, hsla(220,100%,95%,1) 0, transparent 50%), 
                              radial-gradient(at 100% 100%, hsla(250,100%,95%,1) 0, transparent 50%);
        }
        .dark .mesh-gradient {
            background-image: radial-gradient(at 0% 0%, hsla(220,100%,10%,1) 0, transparent 50%), 
                              radial-gradient(at 100% 100%, hsla(250,100%,10%,1) 0, transparent 50%);
        }
    </style>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight leading-none">
                    Submit <span class="text-indigo-600 italic">Request</span>
                </h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">New Official Document</p>
            </div>
            
            <div class="flex items-center space-x-4">
                <!-- FIXED SUN ICON -->
                <button @click="darkMode = !darkMode" class="w-10 h-10 rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-amber-400 hover:scale-110 transition-all flex items-center justify-center flex-shrink-0">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg x-show="darkMode" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>
                </button>

                <div class="px-5 py-2.5 rounded-2xl {{ auth()->user()->role === 1 ? 'bg-rose-50 dark:bg-rose-900/20 border-rose-100 dark:border-rose-800' : 'bg-indigo-50 dark:bg-indigo-900/20 border-indigo-100 dark:border-indigo-800' }}">
                    <span class="text-[11px] font-black {{ auth()->user()->role === 1 ? 'text-rose-700 dark:text-rose-400' : 'text-indigo-700 dark:text-indigo-400' }} uppercase tracking-widest whitespace-nowrap">
                        ● {{ auth()->user()->role === 1 ? 'Administrator' : 'Citizen' }}
                    </span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="mesh-gradient py-12 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 text-left">
            
            @if(session('success'))
                <div class="bg-white dark:bg-slate-900 border-l-4 border-emerald-500 p-6 rounded-3xl shadow-xl text-slate-800 dark:text-white font-bold animate-pulse flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                    <a href="{{ route('dashboard') }}" class="text-indigo-500 dark:text-indigo-400 underline text-sm hover:text-indigo-600 transition-colors font-black uppercase tracking-widest">View Dashboard &rarr;</a>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <div class="lg:col-span-8 space-y-10">
                    <!-- SUBMISSION FORM -->
                    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-2xl dark:shadow-none p-10 border border-slate-100 dark:border-slate-800 transition-all">
                        <h3 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight mb-8">Request Document</h3>
                        <form action="{{ route('requests.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Category</label>
                                    <select name="type" class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl py-5 px-6 text-slate-700 dark:text-slate-200 font-bold shadow-inner transition-all">
                                        <option>Birth Certificate</option>
                                        <option>Business Permit</option>
                                        <option>Police Clearance</option>
                                        <option>Land Certification</option>
                                    </select>
                                </div>
                                <div class="space-y-2" x-data="{ fileName: '', fileSelected: false }">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Attachment</label>
                                    <div class="relative group">
                                        <input type="file" name="document" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" @change="fileSelected = true; fileName = $event.target.files[0].name">
                                        <div :class="fileSelected ? 'border-emerald-400 bg-emerald-50 dark:bg-emerald-900/20' : 'bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700'" class="border-2 border-dashed rounded-2xl py-[18px] px-6 text-center transition-all">
                                            <span class="text-[10px] font-black text-indigo-500 dark:text-indigo-400 uppercase tracking-widest truncate block px-2" x-text="fileSelected ? fileName : 'Attach Document'"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Purpose of Request</label>
                                <textarea name="description" rows="5" class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-3xl py-6 px-6 text-slate-700 dark:text-slate-200 shadow-inner transition-all" placeholder="Briefly explain the intent for this official document..."></textarea>
                            </div>
                            <button type="submit" class="w-full bg-slate-900 dark:bg-indigo-600 py-6 rounded-3xl font-black text-xs uppercase tracking-[0.3em] text-white shadow-2xl hover:scale-[1.01] transition-all hover:bg-indigo-700 shadow-indigo-200 dark:shadow-none">
                                Confirm Official Submission
                            </button>
                        </form>
                    </div>
                </div>

                <!-- SIDEBAR INFORMATION -->
                <div class="lg:col-span-4 space-y-10 text-white text-left">
                    <div class="bg-indigo-600 dark:bg-indigo-900 rounded-[2.5rem] p-10 shadow-2xl shadow-indigo-200 dark:shadow-none transition-all">
                        <h4 class="text-2xl font-black italic tracking-tighter leading-none mb-6">Submission Protocol</h4>
                        <p class="text-sm font-medium opacity-80 border-l-2 pl-4 italic leading-relaxed mb-8 text-indigo-100">"Your application is processed through secure government nodes. Ensure all data is verified before submission."</p>
                        
                        <div class="space-y-6">
                            <div class="flex items-center space-x-4">
                                <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center font-black text-xs italic">01</div>
                                <span class="text-[10px] font-black uppercase tracking-widest">Identity Validation</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center font-black text-xs italic">02</div>
                                <span class="text-[10px] font-black uppercase tracking-widest">Document Auditing</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center font-black text-xs italic">03</div>
                                <span class="text-[10px] font-black uppercase tracking-widest">Digital Certification</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] p-10 shadow-2xl dark:shadow-none border border-slate-100 dark:border-slate-800 text-slate-800 dark:text-slate-400">
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Support Centre</h4>
                        <p class="text-xs font-medium leading-relaxed italic">For urgent inquiries regarding processing times, please contact the district secretariat desk directly.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>