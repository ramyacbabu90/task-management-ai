@if ($errors->any())

    <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-2xl mb-6">

        <ul class="list-disc ml-5">

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>

@endif

<div class="bg-white text-black rounded-3xl p-8 shadow-2xl">

    <div class="space-y-6">

        <!-- Title -->
        <div>

            <label class="block font-semibold mb-2">
                Task Title
            </label>

            <input type="text"
                   name="title"
                   value="{{ old('title', $task->title ?? '') }}"
                   class="w-full border rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Launch New Marketing Campaign">

        </div>

        <!-- Description -->
        <div>

            <label class="block font-semibold mb-2">
                Description
            </label>

            <textarea name="description"
                      rows="5"
                      class="w-full border rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                      placeholder="Task description...">{{ old('description', $task->description ?? '') }}</textarea>

        </div>

        <!-- Priority + Status -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>

                <label class="block font-semibold mb-2">
                    Priority
                </label>

                <select name="priority"
                        class="w-full border rounded-2xl px-4 py-3">

                    <option value="low"
                        @selected(old('priority', $task->priority->value ?? '') === 'low')>
                        Low
                    </option>

                    <option value="medium"
                        @selected(old('priority', $task->priority->value ?? '') === 'medium')>
                        Medium
                    </option>

                    <option value="high"
                        @selected(old('priority', $task->priority->value ?? '') === 'high')>
                        High
                    </option>

                </select>

            </div>

            <div>

                <label class="block font-semibold mb-2">
                    Status
                </label>

                <select name="status"
                        class="w-full border rounded-2xl px-4 py-3">

                    <option value="pending"
                        @selected(old('status', $task->status->value ?? '') === 'pending')>
                        Pending
                    </option>

                    <option value="in_progress"
                        @selected(old('status', $task->status->value ?? '') === 'in_progress')>
                        In Progress
                    </option>

                    <option value="completed"
                        @selected(old('status', $task->status->value ?? '') === 'completed')>
                        Completed
                    </option>

                </select>

            </div>

        </div>

        <!-- Due Date -->
        <div>

            <label class="block font-semibold mb-2">
                Due Date
            </label>

            <input type="date"
                   name="due_date"
                   value="{{ old('due_date', isset($task) && $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
                   class="w-full border rounded-2xl px-4 py-3">

        </div>

        <!-- Assign User -->
        <div>

            <label class="block font-semibold mb-2">
                Assign To
            </label>

            <select name="assigned_to"
                    class="w-full border rounded-2xl px-4 py-3">

                @foreach($users as $user)

                    <option value="{{ $user->id }}"
                        @selected(old('assigned_to', $task->assigned_to ?? '') == $user->id)>

                        {{ $user->name }}

                    </option>

                @endforeach

            </select>

        </div>

        <!-- Buttons -->
        <div class="flex justify-center gap-4 pt-4">

            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 transition text-white px-8 py-3 rounded-2xl font-semibold">

                Save Changes

            </button>

            <a href="{{ route('tasks.index') }}"
               class="bg-gray-200 hover:bg-gray-300 transition px-8 py-3 rounded-2xl font-semibold">

                Cancel

            </a>

        </div>

    </div>

</div>