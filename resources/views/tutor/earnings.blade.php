@extends('layouts.dashboard', ['pageTitle' => 'Earnings'])

@section('content')
<div class="flex flex-col gap-8 pb-8">

    <div>
        <h2 class="text-2xl font-black text-gray-900 tracking-tight">Earnings Overview</h2>
        <p class="text-gray-500 text-sm mt-1">Track your income and upcoming payouts.</p>
    </div>

    {{-- Top Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="dash-card bg-gradient-to-br from-gray-900 to-gray-800 text-white border-0 shadow-lg relative overflow-hidden p-6 md:p-8">
            <div class="absolute top-0 right-0 p-6 opacity-10">
                @include('components.dashboard.icon', ['name' => 'trending-up', 'size' => 120])
            </div>
            <div class="relative z-10">
                <p class="text-gray-400 font-medium mb-2">Available for Payout</p>
                <h3 class="text-4xl sm:text-5xl font-black mb-6">Rs {{ number_format($earnings['pending_payout'], 2) }}</h3>
                <button class="w-full sm:w-auto inline-flex items-center justify-center bg-lime-500 text-white rounded-xl px-6 py-3 text-sm font-bold hover:bg-lime-400 transition-colors shadow-sm">
                    Withdraw Funds
                </button>
            </div>
        </div>

        <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="dash-card p-6 flex flex-col justify-center">
                <div class="flex items-center gap-3 text-gray-500 mb-2">
                    <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                        @include('components.dashboard.icon', ['name' => 'calendar', 'size' => 20])
                    </div>
                    <span class="font-medium text-sm">This Month</span>
                </div>
                <p class="text-3xl font-black text-gray-900">Rs {{ number_format($earnings['this_month'], 2) }}</p>
                <p class="text-sm text-lime-600 font-bold mt-2 flex items-center gap-1">
                    @include('components.dashboard.icon', ['name' => 'trending-up', 'size' => 14])
                    +12% vs last month
                </p>
            </div>
            
            <div class="dash-card p-6 flex flex-col justify-center">
                <div class="flex items-center gap-3 text-gray-500 mb-2">
                    <div class="p-2 bg-purple-50 text-purple-600 rounded-lg">
                        @include('components.dashboard.icon', ['name' => 'video', 'size' => 20])
                    </div>
                    <span class="font-medium text-sm">Completed Lessons</span>
                </div>
                <p class="text-3xl font-black text-gray-900">{{ $earnings['completed_lessons'] }}</p>
                <p class="text-sm text-gray-500 mt-2 font-medium">Average rate: Rs {{ number_format($earnings['average_rate'], 2) }}/hr</p>
            </div>
        </div>

    </div>

    {{-- Chart Placeholder --}}
    <div class="dash-card">
        <div class="dash-card__header border-b border-gray-100">
            <h3 class="dash-card__title">Weekly Activity</h3>
            <div class="flex gap-2">
                <select class="dash-input py-1.5 pl-3 pr-8 text-sm bg-gray-50 border-transparent w-auto">
                    <option>This Week</option>
                    <option>Last Week</option>
                </select>
            </div>
        </div>
        <div class="p-6">
            <div class="h-64 w-full flex items-end justify-between gap-2 sm:gap-6 pt-8 pb-4 border-b border-gray-100 px-4">
                {{-- Mock Bar Chart --}}
                @php $max = max($earnings['chart_data']); @endphp
                @foreach($earnings['chart_data'] as $day => $amount)
                    @php $height = $max > 0 ? ($amount / $max) * 100 : 0; @endphp
                    <div class="flex flex-col items-center justify-end w-full gap-3 group relative">
                        {{-- Tooltip --}}
                        <div class="absolute -top-10 bg-gray-900 text-white text-xs font-bold px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap z-10">
                            Rs {{ $amount }}
                        </div>
                        {{-- Bar --}}
                        <div class="w-full max-w-[40px] bg-lime-100 rounded-t-md relative overflow-hidden transition-all group-hover:bg-lime-200" style="height: 100%;">
                            <div class="absolute bottom-0 w-full bg-lime-500 rounded-t-md transition-all duration-1000" style="height: {{ $height }}%;"></div>
                        </div>
                        {{-- Label --}}
                        <span class="text-xs font-semibold text-gray-500 uppercase">{{ $day }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Recent Transactions --}}
    <div class="dash-card">
        <div class="dash-card__header border-b border-gray-100">
            <h3 class="dash-card__title">Recent Transactions</h3>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse($recentTransactions as $transaction)
                <div class="p-4 sm:p-5 flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-4">
                        @if($transaction->user->avatar_url)
                            <img src="{{ $transaction->user->avatar_url }}" class="w-10 h-10 rounded-full shadow-sm object-cover">
                        @else
                            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 font-bold flex-shrink-0">
                                {{ substr($transaction->user->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <p class="text-sm font-bold text-gray-900">Lesson with {{ $transaction->user->name }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $transaction->scheduled_at->format('M j, Y') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-gray-900">+Rs {{ number_format($tutor->hourly_rate, 2) }}</p>
                        <p class="text-xs font-semibold text-lime-600 bg-lime-50 inline-block px-2 py-0.5 rounded-full mt-1">Cleared</p>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-gray-500 text-sm">
                    No completed lessons yet.
                </div>
            @endforelse
        </div>
        <div class="p-4 border-t border-gray-100 text-center">
            <a href="#" class="text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">View all transactions</a>
        </div>
    </div>

</div>
@endsection
