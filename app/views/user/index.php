<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto max-w-4xl">
     
        
        <div class="bg-white shadow-md rounded overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Username</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Creation Date</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Profile Image</th>
                        <th class="px-4 py-2">Role</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($users) && is_array($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr class="border-b">
                                <td class="px-4 py-2"><?php echo htmlspecialchars($user['id']); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($user['username']); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($user['email']); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($user['created_at']); ?></td>
                                <td class="px-4 py-2">
                                    <span class="<?php 
                                        echo $user['status'] === 'active' 
                                            ? 'text-green-600' 
                                            : 'text-red-600'; 
                                    ?>">
                                        <?php echo htmlspecialchars($user['status']); ?>
                                    </span>
                                </td>
                                <td class="px-4 py-2">
                                    <?php if (!empty($user['profile_image'])): ?>
                                        <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" 
                                             alt="Profile" 
                                             class="w-10 h-10 rounded-full object-cover">
                                    <?php else: ?>
                                        <span class="text-gray-500">No Image</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($user['role']); ?></td>
                                <td class="px-4 py-2">
                                    <div class="flex space-x-2">
                                        <a href="/users/edit/<?= $user['id'] ?>" 
                                           class="text-blue-500 hover:text-blue-700">
                                            Edit
                                        </a>
                                        
                                        <?php if ($user['status'] === 'active'): ?>
                                            <form action="/users/deactivate/<?= $user['id'] ?>" method="POST" style="display: inline;">
                                                <button type="submit" 
                                                        class="text-yellow-500 hover:text-yellow-700"
                                                        onclick="return confirm('Are you sure you want to deactivate this user?')">
                                                    Deactivate
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <form action="/users/activate/<?= $user['id'] ?>" method="POST" style="display: inline;">
                                                <button type="submit" 
                                                        class="text-green-500 hover:text-green-700"
                                                        onclick="return confirm('Are you sure you want to activate this user?')">
                                                    Activate
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                        
                                        <form action="/users/delete/<?= $user['id'] ?>" method="POST" style="display: inline;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" 
                                                    class="text-red-500 hover:text-red-700"
                                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="px-4 py-2 text-center">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>