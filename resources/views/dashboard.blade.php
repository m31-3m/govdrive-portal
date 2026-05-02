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
        .overflow-x-auto::-webkit-scrollbar { height: 6px; }
        .overflow-x-auto::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight leading-none">
                    Tracking <span class="text-indigo-600 italic">Dashboard</span>
                </h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Application Status Overview</p>
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            
            @if(session('success'))
                <div class="bg-white dark:bg-slate-900 border-l-4 border-emerald-500 p-6 rounded-3xl shadow-xl text-slate-800 dark:text-white font-bold animate-pulse">
                    {{ session('success') }}
                </div>
            @endif

            <!-- THE TRACKING TABLE -->
            <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-2xl dark:shadow-none overflow-hidden border border-slate-100 dark:border-slate-800 transition-all">
                <div class="p-10 border-b border-slate-50 dark:border-slate-800 bg-slate-50/20">
                    <h3 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight text-left">Recent Activity</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left min-w-[700px]">
                        <thead class="bg-slate-50/50 dark:bg-slate-800/50 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            <tr>
                                @if(auth()->user()->role === 1) <th class="px-10 py-6">Applicant</th> @endif
                                <th class="px-10 py-6">Service Type</th>
                                <th class="px-10 py-6 text-center">Status</th>
                                <th class="px-10 py-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                            @forelse($requests as $req)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-all text-slate-700 dark:text-slate-300">
                                @if(auth()->user()->role === 1)
                                    <td class="px-10 py-8 font-black text-xs uppercase whitespace-nowrap">{{ $req->user->name }}</td>
                                @endif
                                <td class="px-10 py-8 whitespace-nowrap text-left">
                                    <p class="font-bold text-sm text-slate-900 dark:text-white">{{ $req->type }}</p>
                                    <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold">{{ $req->created_at->format('M d, Y') }}</p>
                                </td>
                                <td class="px-10 py-8 text-center whitespace-nowrap">
                                    <span class="inline-flex justify-center items-center px-4 py-2 rounded-full text-[9px] font-black uppercase tracking-[0.1em] shadow-sm min-w-[85px] leading-none
                                        {{ $req->status === 'approved' ? 'bg-emerald-500 text-white shadow-emerald-500/20' : ($req->status === 'rejected' ? 'bg-rose-500 text-white shadow-rose-500/20' : 'bg-amber-400 text-white shadow-amber-500/20') }}">
                                        {{ $req->status }}
                                    </span>
                                </td>
                                <td class="px-10 py-8 text-right whitespace-nowrap">
                                    <div class="inline-flex justify-end items-center space-x-3">
                                        @if($req->document_path)
                                            <a href="{{ asset('storage/' . $req->document_path) }}" target="_blank" class="p-2.5 bg-slate-100 dark:bg-slate-800 rounded-xl text-slate-600 dark:text-slate-400 hover:text-indigo-500 transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a>
                                        @endif

                                        @can('delete', $req)
                                            <form action="{{ route('requests.destroy', $req->id) }}" method="POST" class="m-0 p-0 inline-block">
                                                @csrf @method('DELETE')
                                                <button type="submit" onclick="return confirm('Archive this record?')" class="p-2.5 bg-slate-100 dark:bg-slate-800 rounded-xl text-slate-400 hover:text-rose-600 transition-all">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        @endcan

                                        @if(auth()->user()->role === 1)
                                            <div class="flex items-center space-x-1 pl-4 border-l border-slate-200 dark:border-slate-700 ml-1">
                                                <form action="{{ route('requests.status', $req->id) }}" method="POST" class="m-0 p-0 inline-block">
                                                    @csrf @method('PATCH') <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="bg-emerald-500 text-white text-[9px] font-black px-3 py-2 rounded-lg hover:bg-emerald-600 transition-all uppercase leading-none">Approve</button>
                                                </form>
                                                <form action="{{ route('requests.status', $req->id) }}" method="POST" class="m-0 p-0 inline-block">
                                                    @csrf @method('PATCH') <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="bg-rose-500 text-white text-[9px] font-black px-3 py-2 rounded-lg hover:bg-rose-600 transition-all uppercase leading-none">Reject</button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="px-10 py-32 text-center text-slate-300 dark:text-slate-600 font-900 uppercase italic tracking-[0.3em]">Vault is empty</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>