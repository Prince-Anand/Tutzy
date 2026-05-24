@extends('layouts.dashboard', ['pageTitle' => 'Settings'])

@section('content')
<div class="flex flex-col gap-6 pb-8 max-w-4xl" x-data="{ 
    tab: new URLSearchParams(window.location.search).get('tab') || 'profile',
    updateUrl(newTab) {
        this.tab = newTab;
        const url = new URL(window.location);
        url.searchParams.set('tab', newTab);
        window.history.pushState({}, '', url);
    }
}">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Tutor Settings</h2>
            <p class="text-gray-500 text-sm mt-1">Manage your public profile, pricing, and availability.</p>
        </div>
        <a href="#" target="_blank" class="text-sm font-bold text-lime-600 hover:text-lime-700 flex items-center gap-2">
            View Public Profile
            @include('components.dashboard.icon', ['name' => 'external-link', 'size' => 14])
        </a>
    </div>

    {{-- Tabs --}}
    <div class="border-b border-gray-200 mt-2 overflow-x-auto">
        <nav class="flex gap-6 -mb-px whitespace-nowrap px-1" aria-label="Tabs">
            <button @click="updateUrl('profile')" class="dash-tab" :class="tab === 'profile' ? 'dash-tab--active' : ''">Public Profile</button>
            <button @click="updateUrl('pricing')" class="dash-tab" :class="tab === 'pricing' ? 'dash-tab--active' : ''">Pricing & Subjects</button>
            <button @click="updateUrl('availability')" class="dash-tab" :class="tab === 'availability' ? 'dash-tab--active' : ''">Availability</button>
            <button @click="updateUrl('payout')" class="dash-tab" :class="tab === 'payout' ? 'dash-tab--active' : ''">Payout Preferences</button>
        </nav>
    </div>

    <div class="mt-4">

        {{-- ── PUBLIC PROFILE TAB ────────────────────────────────────────── --}}
        <div x-show="tab === 'profile'" x-cloak class="flex flex-col gap-6">
            <div class="dash-card">
                <div class="dash-card__header border-b border-gray-100">
                    <h3 class="dash-card__title">Profile Information</h3>
                </div>
                <div class="p-6 sm:p-8">
                    <form action="{{ route('tutor.settings.update') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
                        @csrf
                        
                        {{-- Avatar Upload --}}
                        <div class="flex items-center gap-6" x-data="{ preview: '{{ $tutor->image ? (str_starts_with($tutor->image, 'http') ? $tutor->image : asset('storage/' . $tutor->image)) : '' }}' }">
                            <div class="relative w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-gray-100 flex items-center justify-center overflow-hidden border border-gray-200 shrink-0">
                                <template x-if="preview">
                                    <img :src="preview" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!preview">
                                    <div class="text-3xl font-bold text-gray-400">{{ $user->initials }}</div>
                                </template>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900 mb-1">Profile Photo</h4>
                                <p class="text-xs text-gray-500 mb-3">Professional headshots increase bookings by up to 40%. JPG, GIF or PNG. Max size of 2MB.</p>
                                <label class="dash-btn-outline cursor-pointer text-sm">
                                    Upload Photo
                                    <input type="file" name="avatar" class="hidden" accept="image/*" @change="preview = URL.createObjectURL($event.target.files[0])">
                                </label>
                            </div>
                        </div>

                        <div class="w-full h-px bg-gray-100"></div>

                        {{-- Display Name --}}
                        <div>
                            <label class="dash-label">Display Name</label>
                            <input type="text" name="name" value="{{ old('name', $tutor->name) }}" class="dash-input w-full md:w-1/2">
                        </div>

                        {{-- Country --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="dash-label">Country</label>
                                <input type="text" name="country" value="{{ old('country', $tutor->country) }}" class="dash-input w-full">
                            </div>
                            <div>
                                <label class="dash-label">Spoken Languages</label>
                                <input type="text" name="languages" value="{{ old('languages', $tutor->languages) }}" placeholder="e.g. English, Spanish" class="dash-input w-full">
                            </div>
                        </div>

                        {{-- Bio --}}
                        <div>
                            <label class="dash-label">Professional Bio</label>
                            <textarea name="bio" rows="5" class="dash-input w-full resize-y" placeholder="Tell students about your experience, teaching style, and what to expect...">{{ old('bio', $tutor->bio) }}</textarea>
                            <p class="text-xs text-gray-500 mt-2">Write a compelling bio to attract more students. Mention your experience and teaching methodology.</p>
                        </div>

                        <div class="pt-4 flex justify-end">
                            <button type="submit" class="dash-btn-lime">Save Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ── PRICING & SUBJECTS TAB ─────────────────────────────────────── --}}
        <div x-show="tab === 'pricing'" x-cloak class="flex flex-col gap-6">
            <div class="dash-card">
                <div class="dash-card__header border-b border-gray-100">
                    <h3 class="dash-card__title">Pricing & Expertise</h3>
                </div>
                <div class="p-6 sm:p-8">
                    <form action="{{ route('tutor.settings.update') }}" method="POST" class="flex flex-col gap-6">
                        @csrf
                        
                        {{-- Hourly Rate --}}
                        <div class="w-full md:w-1/2">
                            <label class="dash-label">Hourly Rate (Rs)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 font-bold">Rs</span>
                                <input type="number" step="1" name="hourly_rate" value="{{ old('hourly_rate', $tutor->hourly_rate) }}" class="dash-input w-full" style="padding-left: 45px;" min="50" max="10000">
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Tutzy takes a 15% platform fee on all completed lessons.</p>
                        </div>
                        
                        <div class="w-full h-px bg-gray-100"></div>

                        {{-- Subject & Speciality --}}
                        <div>
                            <label class="dash-label">Primary Subject</label>
                            <select name="subject_id" class="dash-input w-full md:w-1/2">
                                <option value="1" {{ $tutor->subject_id == 1 ? 'selected' : '' }}>English</option>
                                <option value="2" {{ $tutor->subject_id == 2 ? 'selected' : '' }}>Spanish</option>
                                <option value="3" {{ $tutor->subject_id == 3 ? 'selected' : '' }}>Mathematics</option>
                                <option value="4" {{ $tutor->subject_id == 4 ? 'selected' : '' }}>Coding</option>
                            </select>
                        </div>

                        <div>
                            <label class="dash-label">Specialities (comma separated)</label>
                            <input type="text" name="speciality" value="{{ old('speciality', $tutor->speciality) }}" class="dash-input w-full" placeholder="e.g. Calculus, SAT Prep, College Admissions">
                        </div>

                        <div class="pt-4 flex justify-end">
                            <button type="submit" class="dash-btn-lime">Save Pricing</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ── AVAILABILITY TAB ─────────────────────────────────────────── --}}
        <div x-show="tab === 'availability'" x-cloak class="flex flex-col gap-6">
            <div class="dash-card">
                <div class="dash-card__header border-b border-gray-100 flex items-center justify-between">
                    <h3 class="dash-card__title">Weekly Availability</h3>
                </div>
                <div class="p-6 sm:p-8">
                    <form action="{{ route('tutor.settings.availability') }}" method="POST" class="flex flex-col gap-6">
                        @csrf
                        
                        <p class="text-sm text-gray-500 mb-4">Set your regular weekly schedule. This determines when students can book lessons with you.</p>
                        
                        <div class="flex flex-col gap-4">
                            @php
                                $days = [
                                    1 => 'Monday', 
                                    2 => 'Tuesday', 
                                    3 => 'Wednesday', 
                                    4 => 'Thursday', 
                                    5 => 'Friday', 
                                    6 => 'Saturday', 
                                    0 => 'Sunday'
                                ];
                            @endphp

                            @foreach($days as $dayIndex => $dayName)
                                @php
                                    $av = $availabilities->get($dayIndex);
                                    $isAvail = $av ? $av->is_available : false;
                                    $start = $av && $av->start_time ? \Carbon\Carbon::parse($av->start_time)->format('H:i') : '09:00';
                                    $end = $av && $av->end_time ? \Carbon\Carbon::parse($av->end_time)->format('H:i') : '17:00';
                                @endphp
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-4 border border-gray-200 rounded-xl bg-gray-50" x-data="{ isAvail: {{ $isAvail ? 'true' : 'false' }} }">
                                    <div class="flex items-center gap-3 w-32">
                                        <label class="dash-toggle">
                                            <input type="checkbox" name="availabilities[{{ $dayIndex }}][is_available]" value="1" class="peer" x-model="isAvail">
                                            <div class="dash-toggle__track peer-checked:bg-lime-500">
                                                <div class="dash-toggle__thumb peer-checked:translate-x-full"></div>
                                            </div>
                                        </label>
                                        <span class="font-bold text-gray-900" :class="isAvail ? '' : 'text-gray-400'">{{ $dayName }}</span>
                                    </div>
                                    
                                    <div class="flex items-center gap-3" x-show="isAvail">
                                        <input type="time" name="availabilities[{{ $dayIndex }}][start_time]" value="{{ $start }}" class="dash-input py-2">
                                        <span class="text-gray-500 text-sm font-medium">to</span>
                                        <input type="time" name="availabilities[{{ $dayIndex }}][end_time]" value="{{ $end }}" class="dash-input py-2">
                                    </div>
                                    <div class="text-sm text-gray-400 font-medium" x-show="!isAvail">
                                        Unavailable
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="pt-6 flex justify-end">
                            <button type="submit" class="dash-btn-lime">Save Schedule</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ── PAYOUT PREFERENCES TAB ───────────────────────────────────── --}}
        <div x-show="tab === 'payout'" x-cloak class="flex flex-col gap-6">
            <div class="dash-card">
                <div class="dash-card__header border-b border-gray-100">
                    <h3 class="dash-card__title">Payout Method</h3>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-white rounded-lg border border-gray-200 flex items-center justify-center text-gray-900 shadow-sm">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Bank Account</h4>
                                <p class="text-sm text-gray-500">Connected account ending in •••• 4242</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-lime-100 text-lime-800">
                            Active
                        </span>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <h4 class="font-bold text-gray-900 mb-2">Payout Schedule</h4>
                        <p class="text-sm text-gray-600 mb-4">Earnings are automatically processed and sent to your bank account every Monday.</p>
                        <button class="dash-btn-outline">
                            Manage Stripe Account
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
