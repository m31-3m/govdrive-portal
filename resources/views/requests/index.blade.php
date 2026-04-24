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
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">
                    Service <span class="text-indigo-600 italic">Hub</span>
                </h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Official Digital Secretariat</p>
            </div>
            
            <div class="flex items-center space-x-4">
                <button @click="darkMode = !darkMode" class="p-3 rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-amber-400 hover:scale-110 transition-all">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg x-show="darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1z"></path></svg>
                </button>

                <div class="px-5 py-2.5 rounded-2xl {{ auth()->user()->role === 1 ? 'bg-rose-50 dark:bg-rose-900/20 border-rose-100 dark:border-rose-800' : 'bg-indigo-50 dark:bg-indigo-900/20 border-indigo-100 dark:border-indigo-800' }}">
                    <span class="text-[11px] font-black {{ auth()->user()->role === 1 ? 'text-rose-700 dark:text-rose-400' : 'text-indigo-700 dark:text-indigo-400' }} uppercase tracking-widest">
                        ● {{ auth()->user()->role === 1 ? 'Administrator' : 'Citizen' }}
                    </span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="mesh-gradient py-12 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 text-left">
            
            @if(session('success'))
                <div class="bg-white dark:bg-slate-900 border-l-4 border-emerald-500 p-6 rounded-3xl shadow-xl text-slate-800 dark:text-white font-bold animate-pulse">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <div class="lg:col-span-8 space-y-10">
                    <!-- FORM -->
                    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-2xl dark:shadow-none p-10 border border-slate-100 dark:border-slate-800">
                        <h3 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight mb-8">Request Document</h3>
                        <form action="{{ route('requests.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Category</label>
                                    <select name="type" class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl py-5 px-6 text-slate-700 dark:text-slate-200 font-bold shadow-inner">
                                        <option>Birth Certificate</option>
                                        <option>Business Permit</option>
                                        <option>Police Clearance</option>
                                    </select>
                                </div>
                                <div class="space-y-2" x-data="{ fileName: '', fileSelected: false }">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Attachment</label>
                                    <div class="relative group">
                                        <input type="file" name="document" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" @change="fileSelected = true; fileName = $event.target.files[0].name">
                                        <div :class="fileSelected ? 'border-emerald-400 bg-emerald-50 dark:bg-emerald-900/20' : 'bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700'" class="border-2 border-dashed rounded-2xl py-[18px] px-6 text-center transition-all">
                                            <span class="text-[10px] font-black text-indigo-500 dark:text-indigo-400 uppercase tracking-widest" x-text="fileSelected ? fileName : 'Attach Document'"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Purpose</label>
                                <textarea name="description" rows="3" class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-3xl py-6 px-6 text-slate-700 dark:text-slate-200 shadow-inner" placeholder="State reason..."></textarea>
                            </div>
                            <button type="submit" class="w-full bg-slate-900 dark:bg-indigo-600 py-6 rounded-3xl font-black text-xs uppercase tracking-[0.3em] text-white shadow-2xl hover:scale-[1.01] transition-all">
                                Submit Official Application
                            </button>
                        </form>
                    </div>

                    <!-- TABLE -->
                    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-2xl dark:shadow-none overflow-hidden border border-slate-100 dark:border-slate-800">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50/50 dark:bg-slate-800/50 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    <tr>
                                        @if(auth()->user()->role === 1) <th class="px-10 py-6">Applicant</th> @endif
                                        <th class="px-10 py-6">Service</th>
                                        <th class="px-10 py-6">Status</th>
                                        <th class="px-10 py-6 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                                    @foreach($requests as $req)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-all text-slate-700 dark:text-slate-300">
                                        @if(auth()->user()->role === 1)
                                            <td class="px-10 py-8 font-black text-xs uppercase">{{ $req->user->name }}</td>
                                        @endif
                                        <td class="px-10 py-8">
                                            <p class="font-bold text-sm text-slate-900 dark:text-white">{{ $req->type }}</p>
                                            <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold">{{ $req->created_at->format('M d, Y') }}</p>
                                        </td>
                                        <td class="px-10 py-8 text-center">
                                            <span class="px-5 py-2 rounded-xl text-[9px] font-black uppercase
                                                {{ $req->status === 'approved' ? 'bg-emerald-500 text-white' : ($req->status === 'rejected' ? 'bg-rose-500 text-white' : 'bg-amber-400 text-white') }}">
                                                ● {{ $req->status }}
                                            </span>
                                        </td>
                                        <td class="px-10 py-8 text-right flex justify-end items-center space-x-3">
                                            @if($req->document_path)
                                                <a href="{{ asset('storage/' . $req->document_path) }}" target="_blank" class="p-2.5 bg-slate-100 dark:bg-slate-800 rounded-xl text-slate-600 dark:text-slate-400 hover:text-indigo-500">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                </a>
                                            @endif

                                            @can('delete', $req)
                                                <form action="{{ route('requests.destroy', $req) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button class="p-2.5 bg-slate-100 dark:bg-slate-800 rounded-xl text-slate-400 hover:text-rose-600">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            @endcan

                                            @if(auth()->user()->role === 1)
                                                <div class="flex space-x-1 ml-4">
                                                    <form action="{{ route('requests.status', $req) }}" method="POST">@csrf @method('PATCH') <input type="hidden" name="status" value="approved">
                                                        <button class="bg-emerald-500 text-white text-[9px] font-black px-3 py-2 rounded-lg hover:bg-emerald-600 transition-all">Approve</button>
                                                    </form>
                                                    <form action="{{ route('requests.status', $req) }}" method="POST">@csrf @method('PATCH') <input type="hidden" name="status" value="rejected">
                                                        <button class="bg-rose-500 text-white text-[9px] font-black px-3 py-2 rounded-lg hover:bg-rose-600 transition-all">Reject</button>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-4 space-y-10 text-white text-left">
                    <div class="bg-indigo-600 dark:bg-indigo-900 rounded-[2.5rem] p-10 shadow-2xl">
                        <h4 class="text-2xl font-black italic tracking-tighter">Secure Vault</h4>
                        <p class="mt-6 text-sm font-medium opacity-80 border-l-2 pl-4 italic leading-relaxed">System protocols active. All civilian data is encrypted through the official gateway.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>