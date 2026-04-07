<?= $this->extend('template/admin_header'); ?>
<?= $this->section('content') ?>
<div class="dashboard-header">
    <h1>Welcome, <?= session()->get('user_name'); ?>!</h1>
    <p class="subtitle">User Dashboard - Manage Your Account</p>
</div>

<div class="dashboard-stats">
    <div class="stat-card">
        <h3>Total Users</h3>
        <div class="stat-number"><?= $totalUsers; ?></div>
        <p>Registered users</p>
    </div>
    
    <div class="stat-card">
        <h3>Your Role</h3>
        <div class="stat-number"><?= ucfirst(session()->get('user_name')); ?></div>
        <p>Account type</p>
    </div>
    
    <div class="stat-card">
        <h3>Login Time</h3>
        <div class="stat-number"><?= date('H:i', session()->get('login_time')); ?></div>
        <p>Last login</p>
    </div>
</div>

<div class="dashboard-section">
    <h2>Recent Users</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if($recentUsers): foreach($recentUsers as $user): ?>
            <tr>
                <td><?= $user['id']; ?></td>
                <td><?= $user['username']; ?></td>
                <td><?= $user['useremail']; ?></td>
                <td>
                    <span class="status-badge <?= $user['is_active'] ? 'active' : 'inactive'; ?>">
                        <?= $user['is_active'] ? 'Active' : 'Inactive'; ?>
                    </span>
                </td>
            </tr>
            <?php endforeach; else: ?>
            <tr>
                <td colspan="4">No users found.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="dashboard-actions">
    <a href="<?= base_url('/admin/artikel'); ?>" class="btn">Manage Articles</a>
    <a href="<?= base_url('/user/logout'); ?>" class="btn btn-danger">Logout</a>
</div>

<style>
.dashboard-header {
    text-align: center;
    margin-bottom: 2rem;
}

.dashboard-header h1 {
    color: #333;
    margin-bottom: 0.5rem;
}

.subtitle {
    color: #666;
    font-size: 1.1rem;
}

.dashboard-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    text-align: center;
}

.stat-card h3 {
    color: #666;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.stat-number {
    font-size: 2rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 0.5rem;
}

.dashboard-section {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: bold;
}

.status-badge.active {
    background: #d4edda;
    color: #155724;
}

.status-badge.inactive {
    background: #f8d7da;
    color: #721c24;
}

.dashboard-actions {
    text-align: center;
}

.dashboard-actions .btn {
    margin: 0 0.5rem;
}
</style>
<?= $this->endSection() ?>
