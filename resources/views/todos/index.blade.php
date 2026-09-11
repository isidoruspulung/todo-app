<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo App</title>
    <!-- Menggunakan Tailwind CSS untuk styling sederhana -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">ToDo List App</h1>
            <a href="{{ route('todos.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                + Tambah ToDo
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="border border-gray-200 px-4 py-2 text-left">Judul</th>
                        <th class="border border-gray-200 px-4 py-2 text-left">Keterangan</th>
                        <th class="border border-gray-200 px-4 py-2 text-center">Tanggal Dibuat</th>
                        <th class="border border-gray-200 px-4 py-2 text-center">Status</th>
                        <th class="border border-gray-200 px-4 py-2 text-center">Tanggal Selesai</th>
                        <th class="border border-gray-200 px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($todos as $todo)
                        <tr>
                            <td
                                class="border border-gray-200 px-4 py-2 font-medium {{ $todo->is_completed ? 'line-through text-gray-400' : 'text-gray-800' }}">
                                {{ $todo->title }}
                            </td>

                            <td
                                class="border border-gray-200 px-4 py-2 {{ $todo->is_completed ? 'text-gray-400' : 'text-gray-600' }}">
                                {{ $todo->description ?? '-' }}
                            </td>

                            <td
                                class="border border-gray-200 px-4 py-2 text-center text-sm {{ $todo->is_completed ? 'text-gray-400' : 'text-gray-600' }}">
                                {{ \Carbon\Carbon::parse($todo->created_at)->format('d M Y, H:i') }}
                            </td>

                            <td class="border border-gray-200 px-4 py-2 text-center">
                                <form action="{{ route('todos.updateStatus', $todo->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="checkbox" onChange="this.form.submit()"
                                        class="h-5 w-5 text-blue-600 cursor-pointer rounded border-gray-300 focus:ring-blue-500"
                                        {{ $todo->is_completed ? 'checked' : '' }} title="Tandai selesai/belum">
                                </form>
                            </td>

                            <td
                                class="border border-gray-200 px-4 py-2 text-center text-sm {{ $todo->is_completed ? 'text-gray-400' : 'text-gray-600' }}">
                                {{ $todo->completed_at ? \Carbon\Carbon::parse($todo->completed_at)->format('d M Y, H:i') : '-' }}
                            </td>

                            <td class="border border-gray-200 px-4 py-2 text-center">
                                <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus ToDo ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border border-gray-200 px-4 py-4 text-center text-gray-500">
                                Belum ada data ToDo.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>