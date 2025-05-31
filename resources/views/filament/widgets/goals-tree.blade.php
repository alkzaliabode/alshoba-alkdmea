<div class="p-6 bg-white shadow rounded-xl">
    @php
        $mainGoal = $this->getMainGoal();
    @endphp

    @if ($mainGoal)
        <div class="text-center mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-2">🎯 الهدف الرئيسي</h2>
            <p class="text-lg text-blue-700 font-semibold">{{ $mainGoal->goal_text }}</p>
        </div>

        <div class="flex flex-col gap-8">
            @foreach ($mainGoal->departmentGoals as $dept)
                <div class="bg-gray-50 p-4 border-l-4 border-blue-500 shadow rounded">
                    <h3 class="text-blue-800 font-bold mb-2">📌 هدف الشعبة:</h3>
                    <p class="text-gray-700 font-semibold mb-3">{{ $dept->goal_text }}</p>

                    @if ($dept->unitGoals->count())
                        <div class="ml-4 pl-4 border-l-2 border-gray-300">
                            <h4 class="text-green-700 font-bold mb-2">🧩 أهداف الوحدات:</h4>
                            <ul class="list-disc list-inside space-y-1 text-gray-600">
                                @foreach ($dept->unitGoals as $unit)
                                    <li>
                                        <span class="font-bold text-gray-700">[{{ $unit->unit_name }}]</span>
                                        - {{ $unit->goal_text }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-gray-600">لا توجد أهداف مدخلة حالياً.</p>
    @endif
</div>