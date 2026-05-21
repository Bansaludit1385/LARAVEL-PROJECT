<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Article;
use App\Models\Comment;
use App\Models\PracticeProblem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Core Users
        $admin = User::create([
            'name' => 'Alex Admin',
            'email' => 'admin@codespire.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'points' => 1500,
            'bio' => 'Lead administrator & computer systems architect of CodeSpire.',
            'avatar' => 'https://api.dicebear.com/7.x/bottts/svg?seed=alex',
        ]);

        $instructor1 = User::create([
            'name' => 'Dr. Clara Coder',
            'email' => 'clara@codespire.com',
            'password' => Hash::make('password'),
            'role' => 'instructor',
            'points' => 950,
            'bio' => 'Senior Developer Advocate, specialize in Laravel, Distributed Systems, and clean software architecture.',
            'avatar' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=clara&mouth=smile&eyes=happy',
        ]);

        $instructor2 = User::create([
            'name' => 'Prof. Dev Dave',
            'email' => 'dave@codespire.com',
            'password' => Hash::make('password'),
            'role' => 'instructor',
            'points' => 880,
            'bio' => 'Data Scientist & System Engineer with 10+ years teaching experience.',
            'avatar' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=dave&mouth=smile&eyes=happy',
        ]);

        $student = User::create([
            'name' => 'Sam Student',
            'email' => 'student@codespire.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'points' => 320,
            'bio' => 'Passionate computer science student looking to master modern web frameworks.',
            'avatar' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=sam&mouth=smile&eyes=happy',
        ]);

        // 2. Create Categories & Tags
        $sysCat = Category::create([
            'name' => 'Algorithms & DSA',
            'slug' => 'system-design-dsa',
            'description' => 'Design patterns, data structures, algorithms, and high-performance engineering.',
        ]);

        $webDevCat = Category::create([
            'name' => 'Web Development',
            'slug' => 'web-development',
            'description' => 'Modern front-end and back-end web frameworks, architectures, and standard practices.',
        ]);

        $dataCat = Category::create([
            'name' => 'Data Science & AI',
            'slug' => 'data-science-ai',
            'description' => 'Python data ecosystems, Machine Learning algorithms, and Neural Networks.',
        ]);

        $dbCat = Category::create([
            'name' => 'Database Engineering',
            'slug' => 'database-engineering',
            'description' => 'Indexing mechanics, query optimization, ACID transactions, and replication.',
        ]);

        $interviewCat = Category::create([
            'name' => 'Interview Prep',
            'slug' => 'interview-prep',
            'description' => 'Succeed in FAANG algorithmic coding challenges and system architecture rounds.',
        ]);

        $tagPhp = Tag::create(['name' => 'PHP', 'slug' => 'php']);
        $tagLaravel = Tag::create(['name' => 'Laravel', 'slug' => 'laravel']);
        $tagPython = Tag::create(['name' => 'Python', 'slug' => 'python']);
        $tagDsa = Tag::create(['name' => 'DSA', 'slug' => 'dsa']);
        $tagSystemDesign = Tag::create(['name' => 'System Design', 'slug' => 'system-design']);
        $tagSql = Tag::create(['name' => 'SQL', 'slug' => 'sql']);
        $tagCpp = Tag::create(['name' => 'C++', 'slug' => 'cpp']);
        $tagJava = Tag::create(['name' => 'Java', 'slug' => 'java']);
        $tagJs = Tag::create(['name' => 'JavaScript', 'slug' => 'javascript']);
        $tagTs = Tag::create(['name' => 'TypeScript', 'slug' => 'typescript']);
        $tagGo = Tag::create(['name' => 'Go', 'slug' => 'go']);
        $tagCsharp = Tag::create(['name' => 'C#', 'slug' => 'csharp']);

        // 3. Create Courses

        // ==========================================
        // COURSE 1: Mastering Data Structures & Algorithms (DSA)
        // ==========================================
        $dsaCourse = Course::create([
            'user_id' => $instructor1->id,
            'category_id' => $sysCat->id,
            'title' => 'Mastering Data Structures & Algorithms (DSA)',
            'slug' => 'mastering-dsa-algorithms',
            'description' => 'An ultimate guide to mastering foundational computer science algorithms. Covers Time Complexity, Advanced Dynamic Arrays, Floyd\'s Cycle Detection, Binary Search Trees, and Dynamic Programming with clean C++ and Python implementations.',
            'thumbnail' => 'https://images.unsplash.com/photo-1618401471353-b98afee0b2eb?auto=format&fit=crop&q=80&w=600',
            'level' => 'intermediate',
            'price' => 0.00, // Free
            'is_published' => true,
        ]);
        $dsaCourse->tags()->sync([$tagCpp->id, $tagDsa->id]);

        // Lessons
        Lesson::create([
            'course_id' => $dsaCourse->id,
            'title' => 'Time & Space Complexity Analysis (Big O)',
            'slug' => 'time-space-complexity-big-o',
            'content' => <<<'NOWDOC'
### Big O Notation Explained

In computer science, algorithms are analyzed based on their growth rate. **Big O Notation** gives the upper bound of the execution time or memory footprint.

#### Common Time Complexities:
1. **O(1) - Constant Time**: Execution time is independent of input size. Example: Accessing an array element.
2. **O(log N) - Logarithmic Time**: Search space is halved in each step. Example: Binary Search.
3. **O(N) - Linear Time**: Proportional to the input size. Example: Linear scan.
4. **O(N log N) - Linearithmic Time**: Divide-and-conquer sorting. Example: Merge Sort, Quick Sort.
5. **O(N² - Quadratic Time**: Double loops. Example: Bubble Sort.

#### Space Complexity Example:
```cpp
// O(N) space to reverse an array
vector<int> reverseArray(vector<int>& arr) {
    vector<int> temp(arr.rbegin(), arr.rend());
    return temp;
}
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/RBSGKlAftaM',
            'duration_minutes' => 15,
            'sort_order' => 1,
        ]);

        Lesson::create([
            'course_id' => $dsaCourse->id,
            'title' => 'Dynamic Arrays & Two-Pointer Techniques',
            'slug' => 'dynamic-arrays-two-pointer',
            'content' => <<<'NOWDOC'
### Two-Pointer Techniques

The two-pointer technique is a highly efficient algorithmic pattern used to scan linear arrays, reducing time complexity from $O(N^2)$ to $O(N)$.

#### Problem Statement: Two Sum (Sorted Array)
Given a 1-indexed array of integers that is already sorted in non-decreasing order, find two numbers such that they add up to a specific target.

#### C++ Solution:
```cpp
#include <vector>
using namespace std;

vector<int> twoSumSorted(vector<int>& numbers, int target) {
    int left = 0;
    int right = numbers.size() - 1;
    while (left < right) {
        int sum = numbers[left] + numbers[right];
        if (sum == target) {
            return {left + 1, right + 1};
        } else if (sum < target) {
            left++;
        } else {
            right--;
        }
    }
    return {-1, -1};
}
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/RBSGKlAftaM',
            'duration_minutes' => 20,
            'sort_order' => 2,
        ]);

        Lesson::create([
            'course_id' => $dsaCourse->id,
            'title' => 'Linked Lists & Floyd\'s Cycle Detection',
            'slug' => 'linked-lists-floyds-cycle',
            'content' => <<<'NOWDOC'
### Floyd's Cycle-Finding Algorithm (Tortoise and Hare)

Floyd's algorithm uses two pointers moving at different speeds to detect cycles in linear linked lists using $O(1)$ auxiliary space.

- **Slow Pointer**: Moves 1 node per iteration.
- **Fast Pointer**: Moves 2 nodes per iteration.

If a loop exists, the fast pointer will eventually catch up and meet the slow pointer.

#### Python Implementation:
```python
class ListNode:
    def __init__(self, x):
        self.val = x
        self.next = None

def hasCycle(head: ListNode) -> bool:
    if not head or not head.next:
        return False
    slow = head
    fast = head.next
    
    while slow != fast:
        if not fast or not fast.next:
            return False
        slow = slow.next
        fast = fast.next.next
    return True
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/RBSGKlAftaM',
            'duration_minutes' => 25,
            'sort_order' => 3,
        ]);

        Lesson::create([
            'course_id' => $dsaCourse->id,
            'title' => 'Binary Search Trees (BST) & Traversals',
            'slug' => 'binary-search-trees-traversals',
            'content' => <<<'NOWDOC'
### Tree Structures and BST Mechanics

A **Binary Search Tree (BST)** is a node-based binary tree structure where:
1. The left subtree of a node contains only nodes with keys less than the node's key.
2. The right subtree of a node contains only nodes with keys greater than the node's key.

#### BST Node In-order Traversal (Yields Sorted Array):
```python
class TreeNode:
    def __init__(self, val=0, left=None, right=None):
        self.val = val
        self.left = left
        self.right = right

def inorderTraversal(root: TreeNode) -> list:
    res = []
    def traverse(node):
        if node:
            traverse(node.left)
            res.append(node.val)
            traverse(node.right)
    traverse(root)
    return res
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/RBSGKlAftaM',
            'duration_minutes' => 30,
            'sort_order' => 4,
        ]);

        Lesson::create([
            'course_id' => $dsaCourse->id,
            'title' => 'Dynamic Programming: The Knapsack Paradigm',
            'slug' => 'dynamic-programming-knapsack',
            'content' => <<<'NOWDOC'
### 0/1 Knapsack Problem

Dynamic Programming (DP) solves complex sub-problems once and saves answers in a cache lookup table (memoization or tabulation).

#### Recursion Formula:
$$\text{DP}[i][w] = \max(\text{DP}[i-1][w], \text{DP}[i-1][w - w_i] + v_i)$$

#### Python Tabulation Solution:
```python
def knapsack(weights, values, capacity):
    n = len(values)
    dp = [[0] * (capacity + 1) for _ in range(n + 1)]
    
    for i in range(1, n + 1):
        for w in range(1, capacity + 1):
            if weights[i-1] <= w:
                dp[i][w] = max(dp[i-1][w], dp[i-1][w - weights[i-1]] + values[i-1])
            else:
                dp[i][w] = dp[i-1][w]
    return dp[n][capacity]
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/RBSGKlAftaM',
            'duration_minutes' => 35,
            'sort_order' => 5,
        ]);

        // Quiz for DSA
        $dsaQuiz = Quiz::create([
            'course_id' => $dsaCourse->id,
            'title' => 'Foundational DSA Assessment',
            'slug' => 'foundational-dsa-assessment',
            'time_limit_minutes' => 15,
            'pass_percentage' => 80,
        ]);

        Question::create([
            'quiz_id' => $dsaQuiz->id,
            'question_text' => 'What is the time complexity of searching in a balanced Binary Search Tree?',
            'options' => ['O(1)', 'O(log N)', 'O(N)', 'O(N log N)'],
            'correct_option' => 1,
            'points' => 20,
        ]);

        Question::create([
            'quiz_id' => $dsaQuiz->id,
            'question_text' => 'How much space does Floyd\'s cycle detection algorithm use?',
            'options' => ['O(1) space', 'O(N) space', 'O(log N) space', 'O(N²) space'],
            'correct_option' => 0,
            'points' => 20,
        ]);


        // ==========================================
        // COURSE 2: System Design at Scale
        // ==========================================
        $sysCourse = Course::create([
            'user_id' => $instructor1->id,
            'category_id' => $sysCat->id,
            'title' => 'System Design at Scale (Distributed Systems)',
            'slug' => 'system-design-at-scale',
            'description' => 'Architect systems capable of handling billions of active API requests. Master load balancer strategies, consistent hashing, caching eviction, database partitioning, and consensus algorithms.',
            'thumbnail' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&q=80&w=600',
            'level' => 'advanced',
            'price' => 79.99,
            'is_published' => true,
        ]);
        $sysCourse->tags()->sync([$tagSystemDesign->id]);

        // Lessons
        Lesson::create([
            'course_id' => $sysCourse->id,
            'title' => 'Horizontal Scaling & High Availability',
            'slug' => 'horizontal-scaling-high-availability',
            'content' => <<<'NOWDOC'
### Vertical vs Horizontal Scaling

- **Vertical Scaling (Scale-Up)**: Adding resource capacity (CPU, RAM) to a single machine.
- **Horizontal Scaling (Scale-Out)**: Adding nodes to the logical pool.

#### High Availability Design Checklist:
1. Eliminate single points of failure (SPOFs).
2. Configure active-passive and active-active nodes.
3. Establish heartbeat health-check monitors.
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/m8I0fD15Ulg',
            'duration_minutes' => 15,
            'sort_order' => 1,
        ]);

        Lesson::create([
            'course_id' => $sysCourse->id,
            'title' => 'Load Balancing Algorithms',
            'slug' => 'load-balancing-algorithms',
            'content' => <<<'NOWDOC'
### Load Balancing Strategies

Load balancers distribute traffic across multiple backends to prevent resource exhaustion.

#### Key Algorithms:
1. **Round Robin**: Requests cycled sequentially.
2. **Least Connections**: Dispatches to the node handling fewest active connections.
3. **IP Hash**: Hashing IP addresses to bind user sessions to a persistent target.

```nginx
# NGINX Upstream Load Balancer Configuration Example
upstream myapp {
    least_conn;
    server backend1.example.com;
    server backend2.example.com;
}
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/m8I0fD15Ulg',
            'duration_minutes' => 20,
            'sort_order' => 2,
        ]);

        Lesson::create([
            'course_id' => $sysCourse->id,
            'title' => 'Consistent Hashing Ring Implementation',
            'slug' => 'consistent-hashing-ring',
            'content' => <<<'NOWDOC'
### Consistent Hashing Ring

Normal hashing modulo $N$ keys breaks when a server is added or removed, causing massive cache invalidations. Consistent hashing ring addresses this issue by maps both keys and servers to a circular space.

#### Python Code:
```python
import hashlib
import bisect

class HashRing:
    def __init__(self, nodes=None, replicas=3):
        self.replicas = replicas
        self.ring = []
        self.nodes = {}
        if nodes:
            for node in nodes:
                self.add_node(node)

    def add_node(self, node):
        for i in range(self.replicas):
            key = f"{node}-{i}"
            val = int(hashlib.md5(key.encode()).hexdigest(), 16)
            bisect.insort(self.ring, val)
            self.nodes[val] = node
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/m8I0fD15Ulg',
            'duration_minutes' => 25,
            'sort_order' => 3,
        ]);

        Lesson::create([
            'course_id' => $sysCourse->id,
            'title' => 'Distributed Caching Eviction Policies',
            'slug' => 'distributed-caching-eviction',
            'content' => <<<'NOWDOC'
### Caching at Scale

Caching accelerates databases by returning pre-computed values from high-speed memory.

#### Eviction Algorithms:
- **LRU (Least Recently Used)**: Discards the least recently accessed item.
- **LFU (Least Frequently Used)**: Tracks counts of access frequencies.

```python
# Simple LRU Cache using Python Collections
from collections import OrderedDict

class LRUCache:
    def __init__(self, capacity: int):
        self.cache = OrderedDict()
        self.capacity = capacity

    def get(self, key: int) -> int:
        if key not in self.cache:
            return -1
        self.cache.move_to_end(key)
        return self.cache[key]
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/m8I0fD15Ulg',
            'duration_minutes' => 22,
            'sort_order' => 4,
        ]);

        Lesson::create([
            'course_id' => $sysCourse->id,
            'title' => 'Database Sharding & Partitioning Mechanics',
            'slug' => 'database-sharding-partitioning',
            'content' => <<<'NOWDOC'
### Database Partitioning

Database horizontal splitting:
- **Vertical Partitioning**: Splitting tables by columns.
- **Sharding (Horizontal Partitioning)**: Distributing rows across separate server nodes based on a *Sharding Key*.

#### Sharding Keys Best Practices:
1. Uniform distribution (avoid hot spots).
2. Query patterns optimization (avoid cross-shard joins).
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/m8I0fD15Ulg',
            'duration_minutes' => 28,
            'sort_order' => 5,
        ]);


        // ==========================================
        // COURSE 3: Laravel 11: Production SaaS Architecture
        // ==========================================
        $laravelCourse = Course::create([
            'user_id' => $instructor1->id,
            'category_id' => $webDevCat->id,
            'title' => 'Laravel 11: Production SaaS Architecture',
            'slug' => 'laravel-11-saas-architecture',
            'description' => 'Build scalable SaaS applications in PHP. Deep dive into Laravel 11 streamlined routing, polymorphic database designs, real-time background jobs, and robust REST APIs.',
            'thumbnail' => 'https://images.unsplash.com/photo-1542744094-3a31f103e35f?auto=format&fit=crop&q=80&w=600',
            'level' => 'intermediate',
            'price' => 39.99,
            'is_published' => true,
        ]);
        $laravelCourse->tags()->sync([$tagPhp->id, $tagLaravel->id]);

        // Lessons
        Lesson::create([
            'course_id' => $laravelCourse->id,
            'title' => 'Laravel 11 Bootstrap & Streamlined Configs',
            'slug' => 'laravel-11-bootstrap-streamlined-configs',
            'content' => <<<'NOWDOC'
### The Laravel 11 Structure

Laravel 11 simplifies local configuration by housing middleware routing inside `bootstrap/app.php` directly:

```php
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\EncryptCookies::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Exception hook
    })->create();
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/MYyJ4HPc184',
            'duration_minutes' => 15,
            'sort_order' => 1,
        ]);

        Lesson::create([
            'course_id' => $laravelCourse->id,
            'title' => 'Polymorphic Eloquent Relationships',
            'slug' => 'polymorphic-eloquent-relationships',
            'content' => <<<'NOWDOC'
### Eloquent Polymorphism

Polymorphic relations allow a model to belong to more than one other model on a single association.

#### Database structure for polymorphic Comments:
- `commentable_id` (integer)
- `commentable_type` (string, e.g. `App\Models\Lesson`)

#### Inside `Comment.php`:
```php
public function commentable()
{
    return $this->morphTo();
}
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/MYyJ4HPc184',
            'duration_minutes' => 18,
            'sort_order' => 2,
        ]);

        Lesson::create([
            'course_id' => $laravelCourse->id,
            'title' => 'Asynchronous Queues & Background Workers',
            'slug' => 'asynchronous-queues-background-workers',
            'content' => <<<'NOWDOC'
### Offloading Long Requests

Laravel queues permit backgrounding heavy tasks like certificate rendering:

#### Creating a Job class:
```php
namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessCertificate implements ShouldQueue
{
    use Queueable;

    public function __construct(protected User $user) {}

    public function handle(): void
    {
        // Generate PDF...
    }
}
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/MYyJ4HPc184',
            'duration_minutes' => 20,
            'sort_order' => 3,
        ]);

        Lesson::create([
            'course_id' => $laravelCourse->id,
            'title' => 'High-Throughput RESTful APIs with Sanctum',
            'slug' => 'high-throughput-rest-apis-sanctum',
            'content' => <<<'NOWDOC'
### RESTful API Security

Use Laravel Sanctum to issue token credentials:

```php
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

Route::post('/api/tokens/create', function (Request $request) {
    $user = User::where('email', $request->email)->first();
    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }
    return ['token' => $user->createToken('api-token')->plainTextToken];
});
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/MYyJ4HPc184',
            'duration_minutes' => 22,
            'sort_order' => 4,
        ]);

        Lesson::create([
            'course_id' => $laravelCourse->id,
            'title' => 'Comprehensive Unit Testing with PHPUnit',
            'slug' => 'comprehensive-unit-testing',
            'content' => <<<'NOWDOC'
### Writing High-Quality Feature Tests

Use HTTP assertions to test routing:

```php
public function test_guest_is_redirected_from_dashboard(): void
{
    $response = $this->get('/dashboard');
    $response->assertRedirect('/login');
}
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/MYyJ4HPc184',
            'duration_minutes' => 25,
            'sort_order' => 5,
        ]);


        // ==========================================
        // COURSE 4: Database Engineering: SQL Optimization
        // ==========================================
        $dbCourse = Course::create([
            'user_id' => $instructor2->id,
            'category_id' => $dbCat->id,
            'title' => 'Database Engineering: SQL to Replication',
            'slug' => 'database-engineering-sql-replication',
            'description' => 'Become a database expert. Understand internal storage indexing layout, transaction locks, ACID guarantees, query planning, replication types, and transaction recovery.',
            'thumbnail' => 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?auto=format&fit=crop&q=80&w=600',
            'level' => 'advanced',
            'price' => 59.99,
            'is_published' => true,
        ]);
        $dbCourse->tags()->sync([$tagSql->id]);

        // Lessons
        Lesson::create([
            'course_id' => $dbCourse->id,
            'title' => 'ACID Transactions & Isolation Levels',
            'slug' => 'acid-transactions-isolation-levels',
            'content' => <<<'NOWDOC'
### ACID Properties
- **Atomicity**: Entire transaction succeeds or rolls back.
- **Consistency**: Transition from one valid state to another.
- **Isolation**: Concurrent execution leaves database in same state.
- **Durability**: Survives system crashes.

#### SQL Transaction command:
```sql
START TRANSACTION;
UPDATE accounts SET balance = balance - 100 WHERE id = 1;
UPDATE accounts SET balance = balance + 100 WHERE id = 2;
COMMIT;
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/HXRt1F4_yAM',
            'duration_minutes' => 15,
            'sort_order' => 1,
        ]);

        Lesson::create([
            'course_id' => $dbCourse->id,
            'title' => 'B-Tree vs Hash Index Storage Layouts',
            'slug' => 'btree-vs-hash-indexes',
            'content' => <<<'NOWDOC'
### Index Layouts

- **B-Trees**: Keep data sorted, allowing search, sequential access, insertions, and deletions in logarithmic time. Excellent for range queries.
- **Hash Indexes**: Map keys directly using hash codes. Only useful for exact equality comparisons (`=`).
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/HXRt1F4_yAM',
            'duration_minutes' => 20,
            'sort_order' => 2,
        ]);

        Lesson::create([
            'course_id' => $dbCourse->id,
            'title' => 'EXPLAIN Analyze & Execution Plan Optimization',
            'slug' => 'explain-analyze-execution-plan',
            'content' => <<<'NOWDOC'
### Index Scanning and Planning

Prepend `EXPLAIN ANALYZE` to your query to check the engine's query path:

```sql
EXPLAIN ANALYZE SELECT * FROM users WHERE email = 'test@example.com';
```

Look for **Seq Scan** (linear table scan) vs **Index Scan** (using indices).
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/HXRt1F4_yAM',
            'duration_minutes' => 25,
            'sort_order' => 3,
        ]);

        Lesson::create([
            'course_id' => $dbCourse->id,
            'title' => 'Master-Slave Database Replication',
            'slug' => 'master-slave-database-replication',
            'content' => <<<'NOWDOC'
### Read-Write Scaling

Replication distributes read operations across backup instances:

- **Master Database**: Handles all `INSERT`, `UPDATE`, `DELETE` operations. Writes to binlog.
- **Slave Databases**: Read binlog updates asynchronously and service all `SELECT` queries.
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/HXRt1F4_yAM',
            'duration_minutes' => 22,
            'sort_order' => 4,
        ]);

        Lesson::create([
            'course_id' => $dbCourse->id,
            'title' => 'CAP Theorem & NoSQL Distributed Systems',
            'slug' => 'cap-theorem-nosql',
            'content' => <<<'NOWDOC'
### CAP Theorem

A distributed data store can simultaneously provide at most two of the following three guarantees:
1. **Consistency (C)**: Every read receives the most recent write or an error.
2. **Availability (A)**: Every request receives a non-error response.
3. **Partition Tolerance (P)**: The system continues to operate despite network partition errors.
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/HXRt1F4_yAM',
            'duration_minutes' => 30,
            'sort_order' => 5,
        ]);


        // ==========================================
        // COURSE 5: Deep Learning & Transformers
        // ==========================================
        $aiCourse = Course::create([
            'user_id' => $instructor2->id,
            'category_id' => $dataCat->id,
            'title' => 'Deep Learning & Neural Networks with Python',
            'slug' => 'deep-learning-transformers',
            'description' => 'Build high-performance deep networks using PyTorch. Comprehend forward and backward propagation, CNN architectures, Self-Attention blocks, and LLM transformer mechanics.',
            'thumbnail' => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?auto=format&fit=crop&q=80&w=600',
            'level' => 'advanced',
            'price' => 89.99,
            'is_published' => true,
        ]);
        $aiCourse->tags()->sync([$tagPython->id]);

        // Lessons
        Lesson::create([
            'course_id' => $aiCourse->id,
            'title' => 'Artificial Neural Networks & Backprop',
            'slug' => 'neural-networks-backprop',
            'content' => <<<'NOWDOC'
### Forward & Backward Propagation

Neural networks run a forward pass to calculate predictions, find the loss score, and update parameters backward using **gradient descent**.

#### PyTorch Backprop Sample:
```python
import torch

# Initialize random tensors
x = torch.randn(10, 5)
w = torch.randn(5, 3, requires_grad=True)
b = torch.randn(3, requires_grad=True)

# Forward pass
out = torch.matmul(x, w) + b
loss = out.sum()

# Backward pass
loss.backward()

# Access gradients
print("w gradient:", w.grad)
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/aircAruvnKk',
            'duration_minutes' => 15,
            'sort_order' => 1,
        ]);

        Lesson::create([
            'course_id' => $aiCourse->id,
            'title' => 'Non-Linear Activation Functions',
            'slug' => 'activation-functions',
            'content' => <<<'NOWDOC'
### Non-Linear activation
Without non-linear activations, stacking neural layers would collapse into a simple linear mapping.

#### Key Functions:
- **ReLU**: $f(x) = \max(0, x)$
- **Sigmoid**: $f(x) = \frac{1}{1 + e^{-x}}$
- **Softmax**: Normalizes values into probability vectors.
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/aircAruvnKk',
            'duration_minutes' => 18,
            'sort_order' => 2,
        ]);

        Lesson::create([
            'course_id' => $aiCourse->id,
            'title' => 'Convolutional Neural Networks (CNNs)',
            'slug' => 'cnns-computer-vision',
            'content' => <<<'NOWDOC'
### Image Feature Extraction

**Convolutional Neural Networks (CNNs)** use spatial slide kernels to extract visual shapes, edge contours, and texture patterns.

#### Layers layout:
1. **Conv2D**: Slide filters mapping image grids.
2. **MaxPooling**: Downsamples spatial sizes to reduce parameter weight.
3. **Linear (Fully Connected)**: Output score arrays.
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/aircAruvnKk',
            'duration_minutes' => 20,
            'sort_order' => 3,
        ]);

        Lesson::create([
            'course_id' => $aiCourse->id,
            'title' => 'Attention & Transformer Architectures',
            'slug' => 'attention-transformers',
            'content' => <<<'NOWDOC'
### Self-Attention Mechanism

Transformers replaced sequential recurrent units (LSTMs) with a parallelizable self-attention engine:

$$\text{Attention}(Q, K, V) = \text{softmax}\left(\frac{QK^T}{\sqrt{d_k}}\right)V$$
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/aircAruvnKk',
            'duration_minutes' => 30,
            'sort_order' => 4,
        ]);

        Lesson::create([
            'course_id' => $aiCourse->id,
            'title' => 'Fine-Tuning LLMs with Hugging Face',
            'slug' => 'finetuning-llms',
            'content' => <<<'NOWDOC'
### Transfer Learning

Use pre-trained models to solve custom tasks using Hugging Face AutoClasses:

```python
from transformers import AutoModelForSequenceClassification, AutoTokenizer

model_name = "distilbert-base-uncased"
tokenizer = AutoTokenizer.from_pretrained(model_name)
model = AutoModelForSequenceClassification.from_pretrained(model_name, num_labels=2)
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/aircAruvnKk',
            'duration_minutes' => 35,
            'sort_order' => 5,
        ]);


        // ==========================================
        // COURSE 6: Cracking the FAANG Coding Interview
        // ==========================================
        $interviewCourse = Course::create([
            'user_id' => $instructor2->id,
            'category_id' => $interviewCat->id,
            'title' => 'Cracking the FAANG Coding Interview',
            'slug' => 'cracking-faang-interview',
            'description' => 'Master recursive backtracking, sliding window queries, tree graph traversals, and dynamic programming patterns to pass elite technical engineering rounds.',
            'thumbnail' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&q=80&w=600',
            'level' => 'advanced',
            'price' => 0.00, // Free
            'is_published' => true,
        ]);
        $interviewCourse->tags()->sync([$tagDsa->id, $tagCpp->id]);

        // Lessons
        Lesson::create([
            'course_id' => $interviewCourse->id,
            'title' => 'Sliding Window Techniques',
            'slug' => 'sliding-window-techniques',
            'content' => <<<'NOWDOC'
### Sliding Window Technique

Sliding Window tracks sub-segment ranges over arrays, reducing double loops to linear $O(N)$ execution.

#### Problem: Max Sum Subarray of Size K
```cpp
int maxSubarraySum(vector<int>& arr, int k) {
    int max_sum = 0, window_sum = 0;
    for (int i = 0; i < k; i++) window_sum += arr[i];
    max_sum = window_sum;
    for (int i = k; i < arr.size(); i++) {
        window_sum += arr[i] - arr[i - k];
        max_sum = max(max_sum, window_sum);
    }
    return max_sum;
}
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/zH3b51-S4m0',
            'duration_minutes' => 20,
            'sort_order' => 1,
        ]);

        Lesson::create([
            'course_id' => $interviewCourse->id,
            'title' => 'Fast & Slow Pointer Iteration',
            'slug' => 'fast-slow-pointer-iteration',
            'content' => <<<'NOWDOC'
### Two-Pointer Cycle Traversal

Also referred to as the Tortoise and Hare approach. Useful to find midpoints of linked lists and find cycles.

```cpp
ListNode* getMiddle(ListNode* head) {
    ListNode* slow = head;
    ListNode* fast = head;
    while (fast && fast->next) {
        slow = slow->next;
        fast = fast->next->next;
    }
    return slow;
}
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/zH3b51-S4m0',
            'duration_minutes' => 15,
            'sort_order' => 2,
        ]);

        Lesson::create([
            'course_id' => $interviewCourse->id,
            'title' => 'Depth-First Search (DFS) on Graphs',
            'slug' => 'depth-first-search-graphs',
            'content' => <<<'NOWDOC'
### Graph Depth Search

DFS explores graph branches fully before backtracking. Uses a call stack (recursion).

```cpp
#include <vector>
#include <iostream>
using namespace std;

void dfs(int node, vector<vector<int>>& adj, vector<bool>& visited) {
    visited[node] = true;
    for (int neighbor : adj[node]) {
        if (!visited[neighbor]) {
            dfs(neighbor, adj, visited);
        }
    }
}
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/zH3b51-S4m0',
            'duration_minutes' => 25,
            'sort_order' => 3,
        ]);

        Lesson::create([
            'course_id' => $interviewCourse->id,
            'title' => 'Recursive Backtracking: N-Queens Solution',
            'slug' => 'recursive-backtracking-n-queens',
            'content' => <<<'NOWDOC'
### Backtracking Strategy

Backtracking tests candidate solutions and discards path steps immediately when they fail constraints.

#### Classical N-Queens Chess Problem:
Find configurations placing N chess queens on an $N \times N$ chessboard such that no two queens threaten each other.
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/zH3b51-S4m0',
            'duration_minutes' => 30,
            'sort_order' => 4,
        ]);

        Lesson::create([
            'course_id' => $interviewCourse->id,
            'title' => 'Greedy Algorithms & Huffman Encoding',
            'slug' => 'greedy-algorithms-huffman',
            'content' => <<<'NOWDOC'
### Greedy Choice Property

Greedy approach builds up a solution piece by piece, choosing the next piece that offers the most obvious and immediate benefit.

#### Huffman Compression:
Frequencies determine code length. Used in files encoding.
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/zH3b51-S4m0',
            'duration_minutes' => 25,
            'sort_order' => 5,
        ]);


        // 4. Create Articles (GeeksforGeeks-style layouts)
        $a1 = Article::create([
            'user_id' => $instructor1->id,
            'category_id' => $sysCat->id,
            'title' => 'How to Implement Consistent Hashing in System Design',
            'slug' => 'implement-consistent-hashing-system-design',
            'content' => <<<'NOWDOC'
## Introduction to Consistent Hashing

In high-concurrency scalable architectures, horizontal scaling requires distribution of data across a pool of nodes. Standard hash-modulo methods:
$$\text{server_id} = \text{hash}(key) \pmod N$$
suffer severe drawbacks: when $N$ changes (due to nodes shutting down or being added), almost all keys get remapped, leading to a catastrophic cache stampede.

### Consistent Hashing Ring
Consistent hashing distributes data onto an imaginary **hash circle** (ring) representing a fixed integer range.

When a resource request is made, the hash of the key searches clockwise on the circle to find the first server hash greater than or equal to it.

### Code Implementation (Python)
Here is a fast implementation using standard libraries:

```python
import hashlib
import bisect

class ConsistentHashingRing:
    def __init__(self, replicas=3):
        self.replicas = replicas # virtual nodes per actual server
        self.ring = []           # sorted list of virtual node hashes
        self.nodes = {}          # mapping: virtual node hash -> actual server name

    def _hash(self, key: str) -> int:
        return int(hashlib.md5(key.encode('utf-8')).hexdigest(), 16)

    def add_node(self, server_name: str):
        for i in range(self.replicas):
            v_node_key = f"{server_name}-vnode-{i}"
            h_val = self._hash(v_node_key)
            bisect.insort(self.ring, h_val)
            self.nodes[h_val] = server_name
```
NOWDOC
,
            'status' => 'published',
            'views_count' => 3450,
        ]);
        $a1->tags()->sync([$tagSystemDesign->id, $tagDsa->id]);

        $a2 = Article::create([
            'user_id' => $instructor1->id,
            'category_id' => $webDevCat->id,
            'title' => 'Top 10 New Features in Laravel 11 That You Should Know',
            'slug' => 'top-10-new-features-laravel-11',
            'content' => <<<'NOWDOC'
## Discovering Laravel 11's Secrets

Laravel 11 was released with stellar enhancements aimed at developer onboarding speed and performance optimizations.

### 1. Minimal Application Skeleton
Routes are condensed into `routes/web.php` and `routes/console.php`. All core configs have defaults loaded dynamically by the framework, keeping your workspace clean.

### 2. Dumpable Trait integration
A brand new testing feature that allows you to chain a `->dump()` or `->dd()` call on almost any Laravel core class:
```php
User::where('role', 'instructor')->dump()->get();
```
NOWDOC
,
            'status' => 'published',
            'views_count' => 1980,
        ]);
        $a2->tags()->sync([$tagLaravel->id, $tagPhp->id]);

        $a3 = Article::create([
            'user_id' => $instructor2->id,
            'category_id' => $dbCat->id,
            'title' => 'Understanding B-Trees and Database Indexing Mechanics',
            'slug' => 'understanding-btrees-database-indexing',
            'content' => <<<'NOWDOC'
## Database Indexing Layouts

Why are database tables slow to read when they contain millions of records? Because the storage engine has to read every record sequentially on disk to evaluate queries.

### The B-Tree Solution
A B-Tree indexes columns by sorting values into tree structures, facilitating search in logarithmic time.

```
          [ Root Node (50) ]
             /          \
    [ (10, 20) ]      [ (60, 80) ]
```

When looking up `60`, the engine accesses the root, sees `60 > 50`, steps to the right child, and locates the value directly.
NOWDOC
,
            'status' => 'published',
            'views_count' => 2800,
        ]);
        $a3->tags()->sync([$tagSql->id]);

        $a4 = Article::create([
            'user_id' => $instructor2->id,
            'category_id' => $dbCat->id,
            'title' => 'Mastering Redis Cache Eviction Policies & Mitigation',
            'slug' => 'mastering-redis-cache-eviction',
            'content' => <<<'NOWDOC'
## Redis Memory Exhaustion

When Redis instances run out of memory capacity, configured eviction policies dictate which keys are purged to accommodate fresh data writes.

### Primary Policies:
1. **volatile-lru**: Remove the least recently used keys with expire field set.
2. **allkeys-lru**: Evict any key according to LRU algorithm.
3. **noeviction**: Return errors when memory capacity is full.
NOWDOC
,
            'status' => 'published',
            'views_count' => 1560,
        ]);
        $a4->tags()->sync([$tagSystemDesign->id]);

        $a5 = Article::create([
            'user_id' => $instructor1->id,
            'category_id' => $sysCat->id,
            'title' => 'A Deep-Dive into Dijkstra\'s Shortest Path Algorithm',
            'slug' => 'deep-dive-dijkstra-shortest-path',
            'content' => <<<'NOWDOC'
## Dijkstra's Graph Search Algorithm

Dijkstra's algorithm finds the shortest paths from a single source vertex to all other vertices in a weighted graph (with non-negative edge weights).

### Priority Queue Solution (C++):
```cpp
#include <vector>
#include <queue>
using namespace std;

#define INF 0x3f3f3f3f

void shortestPath(vector<vector<pair<int, int>>>& adj, int src, int V) {
    priority_queue<pair<int, int>, vector<pair<int, int>>, greater<pair<int, int>>> pq;
    vector<int> dist(V, INF);

    pq.push(make_pair(0, src));
    dist[src] = 0;

    while (!pq.empty()) {
        int u = pq.top().second;
        pq.pop();

        for (auto x : adj[u]) {
            int v = x.first;
            int weight = x.second;

            if (dist[v] > dist[u] + weight) {
                dist[v] = dist[u] + weight;
                pq.push(make_pair(dist[v], v));
            }
        }
    }
}
```
NOWDOC
,
            'status' => 'published',
            'views_count' => 3120,
        ]);
        $a5->tags()->sync([$tagDsa->id, $tagCpp->id]);

        $a6 = Article::create([
            'user_id' => $instructor1->id,
            'category_id' => $webDevCat->id,
            'title' => 'Building Event-Driven Microservices using RabbitMQ and Laravel',
            'slug' => 'event-driven-microservices-rabbitmq-laravel',
            'content' => <<<'NOWDOC'
## Event-Driven Systems

Decouple back-end microservices by passing messages asynchronously through message brokers like RabbitMQ or Apache Kafka instead of making direct HTTP calls.

### Laravel RabbitMQ Configuration:
Configure AMQP connection queues in config files to publish and consume jobs.
NOWDOC
,
            'status' => 'published',
            'views_count' => 1740,
        ]);
        $a6->tags()->sync([$tagLaravel->id, $tagSystemDesign->id]);


        
        // ==========================================
        // COURSE 7: Introduction to Python Programming
        // ==========================================
        $pythonCourse = Course::create([
            'user_id' => $instructor2->id,
            'category_id' => $dataCat->id,
            'title' => 'Introduction to Python Programming',
            'slug' => 'introduction-to-python-programming',
            'description' => 'A complete beginner-friendly guide to learning Python. Cover syntax, variables, lists, conditional statements, loops, and custom functions.',
            'thumbnail' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&q=80&w=600',
            'level' => 'beginner',
            'price' => 0.00, // Free
            'is_published' => true,
        ]);
        $pythonCourse->tags()->sync([$tagPython->id]);

        Lesson::create([
            'course_id' => $pythonCourse->id,
            'title' => 'Introduction to Python & Syntax',
            'slug' => 'intro-python-syntax',
            'content' => <<<'NOWDOC'
### Python Syntax Essentials

Python is a clean, readable language that uses indentation instead of curly braces to define code blocks.

#### Hello World in Python:
```python
print("Hello, CodeSpire!")
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/_uQrJ0TkZlc',
            'duration_minutes' => 10,
            'sort_order' => 1,
        ]);

        Lesson::create([
            'course_id' => $pythonCourse->id,
            'title' => 'Variables & Core Data Types',
            'slug' => 'python-variables-data-types',
            'content' => <<<'NOWDOC'
### Variables and Data Types

Python is dynamically typed, meaning you do not need to declare variables before using them.

```python
x = 5          # Integer
y = 3.14       # Float
name = "Alice" # String
is_cool = True  # Boolean
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/_uQrJ0TkZlc',
            'duration_minutes' => 12,
            'sort_order' => 2,
        ]);

        Lesson::create([
            'course_id' => $pythonCourse->id,
            'title' => 'Conditional Logic & Branching',
            'slug' => 'python-conditional-logic',
            'content' => <<<'NOWDOC'
### If-Else Statements

Conditional statements evaluate expressions to direct execution:

```python
age = 18
if age >= 18:
    print("Eligible for advanced tracks")
else:
    print("Recommended beginner tracks")
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/_uQrJ0TkZlc',
            'duration_minutes' => 15,
            'sort_order' => 3,
        ]);

        Lesson::create([
            'course_id' => $pythonCourse->id,
            'title' => 'Loop Iteration: For & While',
            'slug' => 'python-loop-iteration',
            'content' => <<<'NOWDOC'
### Iteration structures

Use loops to repeat blocks of code:

```python
# Iterating over range
for i in range(5):
    print(f"Count: {i}")

# While loop
count = 0
while count < 3:
    print("Looping...")
    count += 1
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/_uQrJ0TkZlc',
            'duration_minutes' => 15,
            'sort_order' => 4,
        ]);

        Lesson::create([
            'course_id' => $pythonCourse->id,
            'title' => 'Functions & Scope Mechanics',
            'slug' => 'python-functions-scope',
            'content' => <<<'NOWDOC'
### Defining Functions

Functions are defined using the `def` keyword:

```python
def greet(username):
    return f"Welcome back, {username}!"

print(greet("Sam Student"))
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/_uQrJ0TkZlc',
            'duration_minutes' => 18,
            'sort_order' => 5,
        ]);

        $pythonQuiz = Quiz::create([
            'course_id' => $pythonCourse->id,
            'title' => 'Intro to Python Quiz',
            'slug' => 'intro-to-python-quiz',
            'time_limit_minutes' => 10,
            'pass_percentage' => 80,
        ]);

        Question::create([
            'quiz_id' => $pythonQuiz->id,
            'question_text' => 'Which keyword is used to declare a function in Python?',
            'options' => ['function', 'def', 'void', 'define'],
            'correct_option' => 1,
            'points' => 20,
        ]);


        // ==========================================
        // COURSE 8: Web Development Fundamentals: HTML & CSS
        // ==========================================
        $webdevCourse = Course::create([
            'user_id' => $instructor1->id,
            'category_id' => $webDevCat->id,
            'title' => 'Web Development Fundamentals: HTML & CSS',
            'slug' => 'web-development-fundamentals-html-css',
            'description' => 'Learn the structural foundations of the web. Build static layouts using semantic HTML5, clean CSS selectors, flexbox, grid, and media queries.',
            'thumbnail' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&q=80&w=600',
            'level' => 'beginner',
            'price' => 0.00, // Free
            'is_published' => true,
        ]);
        $webdevCourse->tags()->sync([$tagPhp->id]); // Reuse PHP tag

        Lesson::create([
            'course_id' => $webdevCourse->id,
            'title' => 'The Structure of HTML5 documents',
            'slug' => 'html5-document-structure',
            'content' => <<<'NOWDOC'
### HTML5 Basics

HTML provides structure to web pages through elements (tags).

```html
<!DOCTYPE html>
<html>
<head>
    <title>My First CodeSpire Page</title>
</head>
<body>
    <h1>Welcome to Web Development!</h1>
</body>
</html>
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/mU6anWqOD4g',
            'duration_minutes' => 12,
            'sort_order' => 1,
        ]);

        Lesson::create([
            'course_id' => $webdevCourse->id,
            'title' => 'CSS Selectors & Typography Styling',
            'slug' => 'css-selectors-styling',
            'content' => <<<'NOWDOC'
### CSS Basics

CSS rules target HTML elements to apply visual styles:

```css
h1 {
    color: #10b981; /* CodeSpire Emerald */
    font-family: 'Inter', sans-serif;
    font-size: 24px;
}
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/mU6anWqOD4g',
            'duration_minutes' => 15,
            'sort_order' => 2,
        ]);

        Lesson::create([
            'course_id' => $webdevCourse->id,
            'title' => 'Modern Box Layouts: Flexbox',
            'slug' => 'modern-flexbox-layouts',
            'content' => <<<'NOWDOC'
### CSS Flexbox

Flexbox makes it easy to align children in a container along a single axis:

```css
.container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/mU6anWqOD4g',
            'duration_minutes' => 15,
            'sort_order' => 3,
        ]);

        Lesson::create([
            'course_id' => $webdevCourse->id,
            'title' => 'CSS Grid & Grid Template Areas',
            'slug' => 'css-grid-layouts',
            'content' => <<<'NOWDOC'
### CSS Grid

Grid layout excels at defining two-dimensional structural grids:

```css
.grid-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
}
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/mU6anWqOD4g',
            'duration_minutes' => 18,
            'sort_order' => 4,
        ]);

        Lesson::create([
            'course_id' => $webdevCourse->id,
            'title' => 'Media Queries & Responsive Design',
            'slug' => 'media-queries-responsive',
            'content' => <<<'NOWDOC'
### Responsive Design

Use media queries to alter layout styles for different screen viewports:

```css
@media (max-width: 768px) {
    .grid-container {
        grid-template-columns: 1fr;
    }
}
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/mU6anWqOD4g',
            'duration_minutes' => 20,
            'sort_order' => 5,
        ]);

        $webdevQuiz = Quiz::create([
            'course_id' => $webdevCourse->id,
            'title' => 'Intro to HTML & CSS Quiz',
            'slug' => 'intro-to-html-css-quiz',
            'time_limit_minutes' => 10,
            'pass_percentage' => 80,
        ]);

        Question::create([
            'quiz_id' => $webdevQuiz->id,
            'question_text' => 'Which CSS property triggers Flexbox layouts?',
            'options' => ['display: block', 'display: grid', 'display: flex', 'align-items: center'],
            'correct_option' => 2,
            'points' => 20,
        ]);


        // ==========================================
        // COURSE 9: Java Foundations: OOP and Core API (Java - Beginner)
        // ==========================================
        $javaIntroCourse = Course::create([
            'user_id' => $instructor1->id,
            'category_id' => $sysCat->id,
            'title' => 'Java Foundations: OOP & Core APIs',
            'slug' => 'java-foundations-oop-core-apis',
            'description' => 'A robust introduction to Java programming. Master standard syntax, class structures, Object-Oriented Principles (OOP), and the powerful Java Collections framework.',
            'thumbnail' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&q=80&w=600',
            'level' => 'beginner',
            'price' => 0.00,
            'is_published' => true,
        ]);
        $javaIntroCourse->tags()->sync([$tagJava->id, $tagDsa->id]);

        Lesson::create([
            'course_id' => $javaIntroCourse->id,
            'title' => 'Java JVM & Basic Class Structure',
            'slug' => 'java-jvm-basic-class-structure',
            'content' => <<<'NOWDOC'
### Java Virtual Machine (JVM) & Syntax

Java is a compiled, class-based, object-oriented language designed to have as few implementation dependencies as possible (Write Once, Run Anywhere).

#### The JVM Pipeline:
1. **Compilation**: Java Compiler (`javac`) translates source code (`.java`) to Bytecode (`.class`).
2. **Execution**: The JVM JIT (Just-In-Time) compiler translates bytecode to machine code.

#### Basic HelloWorld Class:
```java
public class Main {
    public static void main(String[] args) {
        System.out.println("Hello, CodeSpire!");
    }
}
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/eIrMbAQSU34',
            'duration_minutes' => 15,
            'sort_order' => 1,
        ]);

        Lesson::create([
            'course_id' => $javaIntroCourse->id,
            'title' => 'Object-Oriented Programming: Inheritance & Polymorphism',
            'slug' => 'java-oop-inheritance-polymorphism',
            'content' => <<<'NOWDOC'
### Object-Oriented Pillars in Java

Java enforces OOP. Here is a quick review of key concepts:

#### 1. Encapsulation:
Hiding internal state via `private` fields and exposing `public` getters/setters.

#### 2. Inheritance:
Deriving subclasses using the `extends` keyword.

#### 3. Polymorphism:
Overriding superclass methods to achieve dynamic dispatch.

```java
class Animal {
    public void makeSound() {
        System.out.println("Generic sound");
    }
}

class Dog extends Animal {
    @Override
    public void makeSound() {
        System.out.println("Woof Woof!");
    }
}
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/eIrMbAQSU34',
            'duration_minutes' => 20,
            'sort_order' => 2,
        ]);

        Lesson::create([
            'course_id' => $javaIntroCourse->id,
            'title' => 'Java Collections Framework: Lists, Sets & Maps',
            'slug' => 'java-collections-framework',
            'content' => <<<'NOWDOC'
### Java Collections Framework

Collections provide powerful structures to manage lists, unique sets, and key-value maps.

#### ArrayList (Dynamic Array):
```java
List<String> fruits = new ArrayList<>();
fruits.add("Apple");
fruits.add("Banana");
```

#### HashSet (Unique Elements):
```java
Set<Integer> uniqueIds = new HashSet<>();
uniqueIds.add(101);
```

#### HashMap (Key-Value Pairs):
```java
Map<String, Integer> scores = new HashMap<>();
scores.put("Sam", 95);
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/eIrMbAQSU34',
            'duration_minutes' => 18,
            'sort_order' => 3,
        ]);

        $javaIntroQuiz = Quiz::create([
            'course_id' => $javaIntroCourse->id,
            'title' => 'Java OOP Foundations Quiz',
            'slug' => 'java-oop-foundations-quiz',
            'time_limit_minutes' => 10,
            'pass_percentage' => 80,
        ]);

        Question::create([
            'quiz_id' => $javaIntroQuiz->id,
            'question_text' => 'Which keyword is used to inherit a class in Java?',
            'options' => ['implements', 'extends', 'inherits', 'super'],
            'correct_option' => 1,
            'points' => 20,
        ]);

        // ==========================================
        // COURSE 10: Spring Boot Microservices (Java - Advanced)
        // ==========================================
        $springCourse = Course::create([
            'user_id' => $instructor1->id,
            'category_id' => $webDevCat->id,
            'title' => 'Enterprise Java: Spring Boot & Microservices',
            'slug' => 'enterprise-java-spring-boot-microservices',
            'description' => 'Build highly scalable, production-ready enterprise systems. Dive into Spring IOC, REST APIs, Spring Security, Hibernate ORM, and Eureka microservice patterns.',
            'thumbnail' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&q=80&w=600',
            'level' => 'advanced',
            'price' => 0.00,
            'is_published' => true,
        ]);
        $springCourse->tags()->sync([$tagJava->id, $tagSystemDesign->id]);

        Lesson::create([
            'course_id' => $springCourse->id,
            'title' => 'Spring IOC & Dependency Injection',
            'slug' => 'spring-ioc-dependency-injection',
            'content' => <<<'NOWDOC'
### Spring Inversion of Control (IOC)

Spring handles object lifecycles and relationships via an IOC Container. Rather than instantiating class dependencies manually (`new Service()`), Spring injects them automatically.

#### Using Dependency Injection (`@Autowired` or Constructor):
```java
@Component
public class PaymentProcessor {
    private final PaymentGateway gateway;

    @Autowired
    public PaymentProcessor(PaymentGateway gateway) {
        this.gateway = gateway;
    }
}
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/gq4S-NhsSeU',
            'duration_minutes' => 25,
            'sort_order' => 1,
        ]);

        Lesson::create([
            'course_id' => $springCourse->id,
            'title' => 'REST APIs with Spring Boot Controller & JPA',
            'slug' => 'rest-apis-spring-boot-jpa',
            'content' => <<<'NOWDOC'
### Building REST APIs with Spring MVC

Spring Boot simplifies REST API production. Connect controller endpoints directly to JPA database operations.

```java
@RestController
@RequestMapping("/api/products")
public class ProductController {
    
    @Autowired
    private ProductRepository repository;

    @GetMapping
    public List<Product> getAllProducts() {
        return repository.findAll();
    }
}
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/gq4S-NhsSeU',
            'duration_minutes' => 30,
            'sort_order' => 2,
        ]);

        $springQuiz = Quiz::create([
            'course_id' => $springCourse->id,
            'title' => 'Spring Boot & JPA Core Quiz',
            'slug' => 'spring-boot-jpa-core-quiz',
            'time_limit_minutes' => 12,
            'pass_percentage' => 80,
        ]);

        Question::create([
            'quiz_id' => $springQuiz->id,
            'question_text' => 'Which annotation is used to declare a REST controller in Spring Boot?',
            'options' => ['@Controller', '@RestController', '@Service', '@Component'],
            'correct_option' => 1,
            'points' => 20,
        ]);

        // ==========================================
        // COURSE 11: Modern JavaScript & TypeScript (JS - Beginner)
        // ==========================================
        $jsCourse = Course::create([
            'user_id' => $instructor2->id,
            'category_id' => $webDevCat->id,
            'title' => 'Modern JavaScript & TypeScript: Zero to Hero',
            'slug' => 'modern-javascript-typescript-zero-to-hero',
            'description' => 'Master the most popular runtime engine in the world. Advance from fundamental ES6+ closures, promises, and the Event Loop into TypeScript typing systems.',
            'thumbnail' => 'https://images.unsplash.com/photo-1579468118864-1b9ea3c0db4a?auto=format&fit=crop&q=80&w=600',
            'level' => 'beginner',
            'price' => 0.00,
            'is_published' => true,
        ]);
        $jsCourse->tags()->sync([$tagJs->id, $tagTs->id]);

        Lesson::create([
            'course_id' => $jsCourse->id,
            'title' => 'Modern ES6+ Closures & Promises',
            'slug' => 'modern-es6-closures-promises',
            'content' => <<<'NOWDOC'
### Modern ES6+ JavaScript Features

JavaScript ES6 introduced key features including Arrow Functions, Destructuring, Promises, and Modules.

#### Arrow Functions & Closures:
```javascript
const makeCounter = () => {
    let count = 0;
    return () => ++count;
};
const counter = makeCounter();
console.log(counter()); // 1
```

#### Async/Await & Promises:
```javascript
const fetchData = async () => {
    try {
        const response = await fetch('https://api.github.com/users');
        const data = await response.json();
        console.log(data);
    } catch (err) {
        console.error("Fetch failed", err);
    }
};
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/W6NZfCO5SIk',
            'duration_minutes' => 18,
            'sort_order' => 1,
        ]);

        Lesson::create([
            'course_id' => $jsCourse->id,
            'title' => 'TypeScript strong-typing & interfaces',
            'slug' => 'typescript-strong-typing-interfaces',
            'content' => <<<'NOWDOC'
### Introduction to TypeScript

TypeScript adds optional strong typing to JavaScript, preventing runtime errors during local builds.

#### Creating Interfaces:
```typescript
interface UserProfile {
    id: number;
    username: string;
    email: string;
    points?: number; // Optional
}

const showProfile = (user: UserProfile): void => {
    console.log(`User ${user.username} has ${user.points ?? 0} points.`);
};

showProfile({ id: 1, username: "Sam Student", email: "sam@student.com" });
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/zQnOBmK1x3A',
            'duration_minutes' => 22,
            'sort_order' => 2,
        ]);

        $jsQuiz = Quiz::create([
            'course_id' => $jsCourse->id,
            'title' => 'JS & TS Core Quiz',
            'slug' => 'js-ts-core-quiz',
            'time_limit_minutes' => 10,
            'pass_percentage' => 80,
        ]);

        Question::create([
            'quiz_id' => $jsQuiz->id,
            'question_text' => 'Which typescript suffix marks a profile parameter field as optional?',
            'options' => ['!', '?', '*', '&'],
            'correct_option' => 1,
            'points' => 20,
        ]);

        // ==========================================
        // COURSE 12: High-Performance Go (Golang) Microservices (Go - Intermediate)
        // ==========================================
        $goCourse = Course::create([
            'user_id' => $instructor1->id,
            'category_id' => $sysCat->id,
            'title' => 'High-Performance Go (Golang) Microservices',
            'slug' => 'high-performance-go-golang-microservices',
            'description' => 'Unlock blazing-fast execution. Master Go concurrency channels, goroutines, memory pointer behaviors, and construct high-performance microservice routers.',
            'thumbnail' => 'https://images.unsplash.com/photo-1525547719571-a2d4ac8945e2?auto=format&fit=crop&q=80&w=600',
            'level' => 'intermediate',
            'price' => 0.00,
            'is_published' => true,
        ]);
        $goCourse->tags()->sync([$tagGo->id, $tagSystemDesign->id]);

        Lesson::create([
            'course_id' => $goCourse->id,
            'title' => 'Go Concurrency: Goroutines & Channels',
            'slug' => 'go-concurrency-goroutines-channels',
            'content' => <<<'NOWDOC'
### Go Concurrency Model

Golang features CSP (Communicating Sequential Processes) concurrency using ultra-lightweight threads called **Goroutines** communicating via **Channels**.

```go
package main

import (
    "fmt"
    "time"
)

func processTask(id int, ch chan string) {
    time.Sleep(100 * time.Millisecond)
    ch <- fmt.Sprintf("Task %d completed", id)
}

func main() {
    ch := make(chan string)
    go processTask(1, ch)
    
    result := <-ch
    fmt.Println(result)
}
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/un6ZyFkqFKo',
            'duration_minutes' => 20,
            'sort_order' => 1,
        ]);

        $goQuiz = Quiz::create([
            'course_id' => $goCourse->id,
            'title' => 'Go Concurrency Basics Quiz',
            'slug' => 'go-concurrency-basics-quiz',
            'time_limit_minutes' => 10,
            'pass_percentage' => 80,
        ]);

        Question::create([
            'quiz_id' => $goQuiz->id,
            'question_text' => 'Which keyword starts an asynchronous goroutine in Go?',
            'options' => ['async', 'thread', 'go', 'routine'],
            'correct_option' => 2,
            'points' => 20,
        ]);

        // ==========================================
        // COURSE 13: Enterprise C# and .NET Core APIs (C# - Intermediate)
        // ==========================================
        $csharpCourse = Course::create([
            'user_id' => $instructor2->id,
            'category_id' => $webDevCat->id,
            'title' => 'Enterprise C# and .NET Core Web APIs',
            'slug' => 'enterprise-csharp-net-core-web-apis',
            'description' => 'Build high-performance backends. Master object structures, advanced LINQ queries, and compile robust Web APIs using ASP.NET Core & Entity Framework Core.',
            'thumbnail' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&q=80&w=600',
            'level' => 'intermediate',
            'price' => 0.00,
            'is_published' => true,
        ]);
        $csharpCourse->tags()->sync([$tagCsharp->id, $tagSql->id]);

        Lesson::create([
            'course_id' => $csharpCourse->id,
            'title' => 'LINQ Queries & Database Integration',
            'slug' => 'linq-queries-database-integration',
            'content' => <<<'NOWDOC'
### C# LINQ (Language Integrated Query)

C# LINQ allows you to write SQL-like declarative queries directly against collections or Entity Framework databases.

```csharp
using System;
using System.Linq;
using System.Collections.Generic;

public class Program {
    public static void Main() {
        List<int> numbers = new List<int> { 1, 2, 3, 4, 5, 6 };
        
        // Filter even numbers
        var evenNumbers = numbers.Where(n => n % 2 == 0).ToList();
        
        foreach (var num in evenNumbers) {
            Console.WriteLine(num);
        }
    }
}
```
NOWDOC
,
            'video_url' => 'https://www.youtube.com/embed/gU9Uj2D3gEU',
            'duration_minutes' => 22,
            'sort_order' => 1,
        ]);

        $csharpQuiz = Quiz::create([
            'course_id' => $csharpCourse->id,
            'title' => 'C# LINQ Basics Quiz',
            'slug' => 'c-sharp-linq-basics-quiz',
            'time_limit_minutes' => 10,
            'pass_percentage' => 80,
        ]);

        Question::create([
            'quiz_id' => $csharpQuiz->id,
            'question_text' => 'Which LINQ operator is used to filter records based on a predicate?',
            'options' => ['Select', 'Where', 'Filter', 'Find'],
            'correct_option' => 1,
            'points' => 20,
        ]);


// 5. Add Seed Comments for Interactivity
        Comment::create([
            'user_id' => $student->id,
            'commentable_type' => Article::class,
            'commentable_id' => $a1->id,
            'content' => 'Consistent hashing was a bit confusing for me, but the Python implementation using bisect and virtual nodes makes complete sense now! Thanks for sharing.',
        ]);

        Comment::create([
            'user_id' => $instructor2->id,
            'commentable_type' => Article::class,
            'commentable_id' => $a1->id,
            'content' => 'Excellent review. Adding virtual nodes is indeed crucial to distribute key-load evenly among servers.',
        ]);

        // 6. Create Practice Problems
        $problems = [
            // EASY PROBLEMS (1 to 10)
            [
                'title' => 'Two Sum',
                'slug' => 'two-sum',
                'difficulty' => 'easy',
                'category' => 'Array',
                'description' => "### Problem Statement\nGiven an array of integers `nums` and an integer `target`, return indices of the two numbers such that they add up to `target`.\n\nYou may assume that each input would have **exactly one solution**, and you may not use the same element twice. You can return the answer in any order.\n\n### Examples\n**Example 1:**\n* **Input:** `nums = [2, 7, 11, 15]`, `target = 9`\n* **Output:** `[0, 1]`\n* **Explanation:** Because `nums[0] + nums[1] == 2 + 7 == 9`, we return `[0, 1]`.\n\n**Example 2:**\n* **Input:** `nums = [3, 2, 4]`, `target = 6`\n* **Output:** `[1, 2]`\n* **Explanation:** Because `nums[1] + nums[2] == 2 + 4 == 6`, we return `[1, 2]`.\n\n**Example 3:**\n* **Input:** `nums = [3, 3]`, `target = 6`\n* **Output:** `[0, 1]`\n\n### Constraints\n* `2 <= nums.length <= 10^4`\n* `-10^9 <= nums[i] <= 10^9`\n* `-10^9 <= target <= 10^9`\n* **Only one valid answer exists.**",
                'starter_code_py' => "def twoSum(nums, target):\n    # Write Python solution here\n    pass\n\nprint(twoSum([2, 7, 11, 15], 9))",
                'starter_code_cpp' => "#include <iostream>\n#include <vector>\nusing namespace std;\n\nvector<int> twoSum(vector<int>& nums, int target) {\n    // Write C++ solution here\n    return {0, 1};\n}\n\nint main() {\n    cout << \"[0, 1]\" << endl;\n    return 0;\n}",
                'starter_code_java' => "import java.util.*;\n\nclass Solution {\n    public int[] twoSum(int[] nums, int target) {\n        // Write Java solution here\n        return new int[]{0, 1};\n    }\n    \n    public static void main(String[] args) {\n        System.out.println(\"[0, 1]\");\n    }\n}"
            ],
            [
                'title' => 'Reverse String',
                'slug' => 'reverse-string',
                'difficulty' => 'easy',
                'category' => 'String',
                'description' => "### Problem Statement\nWrite a function that reverses a string. The input string is given as an array of characters `s`.\n\nYou must do this by modifying the input array **in-place** with `O(1)` extra memory.\n\n### Examples\n**Example 1:**\n* **Input:** `s = [\"h\",\"e\",\"l\",\"l\",\"o\"]`\n* **Output:** `[\"o\",\"l\",\"l\",\"e\",\"h\"]`\n\n**Example 2:**\n* **Input:** `s = [\"H\",\"a\",\"n\",\"n\",\"a\",\"h\"]`\n* **Output:** `[\"h\",\"a\",\"n\",\"n\",\"a\",\"H\"]`\n\n### Constraints\n* `1 <= s.length <= 10^5`\n* `s[i]` is a printable ascii character.",
                'starter_code_py' => "def reverseString(s):\n    # Write Python solution here\n    s.reverse()\n\nchars = [\"h\",\"e\",\"l\",\"l\",\"o\"]\nreverseString(chars)\nprint(chars)",
                'starter_code_cpp' => "#include <iostream>\n#include <vector>\n#include <algorithm>\nusing namespace std;\n\nvoid reverseString(vector<char>& s) {\n    // Write C++ solution here\n    reverse(s.begin(), s.end());\n}\n\nint main() {\n    cout << \"[o, l, l, e, h]\" << endl;\n    return 0;\n}",
                'starter_code_java' => "import java.util.*;\n\nclass Solution {\n    public void reverseString(char[] s) {\n        // Write Java solution here\n    }\n    \n    public static void main(String[] args) {\n        System.out.println(\"[o, l, l, e, h]\");\n    }\n}"
            ],
            [
                'title' => 'Valid Parentheses',
                'slug' => 'valid-parentheses',
                'difficulty' => 'easy',
                'category' => 'Stack',
                'description' => "### Problem Statement\nGiven a string `s` containing just the characters `'('`, `')'`, `'{'`, `'}'`, `'['` and `']'`, determine if the input string is valid.\n\nAn input string is valid if:\n1. Open brackets must be closed by the same type of brackets.\n2. Open brackets must be closed in the correct order.\n3. Every close bracket has a corresponding open bracket of the same type.\n\n### Examples\n**Example 1:**\n* **Input:** `s = \"()\"`\n* **Output:** `true`\n\n**Example 2:**\n* **Input:** `s = \"()[]{}\"`\n* **Output:** `true`\n\n**Example 3:**\n* **Input:** `s = \"(]\"`\n* **Output:** `false`\n\n### Constraints\n* `1 <= s.length <= 10^4`\n* `s` consists of parentheses only `'()[]{}'`.",
                'starter_code_py' => "def isValid(s):\n    # Write Python solution here\n    return True\n\nprint(isValid(\"()[]{}\"))",
                'starter_code_cpp' => "#include <iostream>\n#include <string>\nusing namespace std;\n\nbool isValid(string s) {\n    // Write C++ solution here\n    return true;\n}\n\nint main() {\n    cout << \"true\" << endl;\n    return 0;\n}",
                'starter_code_java' => "import java.util.*;\n\nclass Solution {\n    public boolean isValid(String s) {\n        // Write Java solution here\n        return true;\n    }\n    \n    public static void main(String[] args) {\n        System.out.println(\"true\");\n    }\n}"
            ],
            [
                'title' => 'Palindrome Number',
                'slug' => 'palindrome-number',
                'difficulty' => 'easy',
                'category' => 'Math',
                'description' => "### Problem Statement\nGiven an integer `x`, return `true` if `x` is a **palindrome**, and `false` otherwise.\n\nAn integer is a palindrome when it reads the same backward as forward. For example, `121` is a palindrome while `123` is not.\n\n### Examples\n**Example 1:**\n* **Input:** `x = 121`\n* **Output:** `true`\n* **Explanation:** `121` reads as `121` from left to right and from right to left.\n\n**Example 2:**\n* **Input:** `x = -121`\n* **Output:** `false`\n* **Explanation:** From left to right, it reads `-121`. From right to left, it becomes `121-`. Therefore it is not a palindrome.\n\n**Example 3:**\n* **Input:** `x = 10`\n* **Output:** `false`\n* **Explanation:** Reads `01` from right to left. Therefore it is not a palindrome.\n\n### Constraints\n* `-2^31 <= x <= 2^31 - 1`",
                'starter_code_py' => "def isPalindrome(x):\n    # Write Python solution here\n    return True\n\nprint(isPalindrome(121))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nbool isPalindrome(int x) {\n    // Write C++ solution here\n    return true;\n}\n\nint main() {\n    cout << \"true\" << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public boolean isPalindrome(int x) {\n        // Write Java solution here\n        return true;\n    }\n    \n    public static void main(String[] args) {\n        System.out.println(\"true\");\n    }\n}"
            ],
            [
                'title' => 'Merge Two Sorted Lists',
                'slug' => 'merge-two-sorted-lists',
                'difficulty' => 'easy',
                'category' => 'Linked List',
                'description' => "### Problem Statement\nYou are given the heads of two sorted linked lists `list1` and `list2`.\n\nMerge the two lists into one **sorted** list. The list should be made by splicing together the nodes of the first two lists.\n\nReturn *the head of the merged linked list*.\n\n### Examples\n**Example 1:**\n* **Input:** `list1 = [1,2,4]`, `list2 = [1,3,4]`\n* **Output:** `[1,1,2,3,4,4]`\n\n**Example 2:**\n* **Input:** `list1 = []`, `list2 = []`\n* **Output:** `[]`\n\n**Example 3:**\n* **Input:** `list1 = []`, `list2 = [0]`\n* **Output:** `[0]`\n\n### Constraints\n* The number of nodes in both lists is in the range `[0, 50]`.\n* `-100 <= Node.val <= 100`\n* Both `list1` and `list2` are sorted in non-decreasing order.",
                'starter_code_py' => "def mergeTwoLists(list1, list2):\n    # Write Python solution here\n    return sorted(list1 + list2)\n\nprint(mergeTwoLists([1,2,4], [1,3,4]))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << \"[1, 1, 2, 3, 4, 4]\" << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(\"[1, 1, 2, 3, 4, 4]\");\n    }\n}"
            ],
            [
                'title' => 'Maximum Subarray',
                'slug' => 'maximum-subarray',
                'difficulty' => 'easy',
                'category' => 'Dynamic Programming',
                'description' => "### Problem Statement\nGiven an integer array `nums`, find the subarray with the largest sum, and return *its sum*.\n\nA **subarray** is a contiguous non-empty sequence of elements within an array.\n\n### Examples\n**Example 1:**\n* **Input:** `nums = [-2,1,-3,4,-1,2,1,-5,4]`\n* **Output:** `6`\n* **Explanation:** The subarray `[4,-1,2,1]` has the largest sum `6`.\n\n**Example 2:**\n* **Input:** `nums = [1]`\n* **Output:** `1`\n* **Explanation:** The subarray `[1]` has the largest sum `1`.\n\n**Example 3:**\n* **Input:** `nums = [5,4,-1,7,8]`\n* **Output:** `23`\n* **Explanation:** The subarray `[5,4,-1,7,8]` has the largest sum `23`.\n\n### Constraints\n* `1 <= nums.length <= 10^5`\n* `-10^4 <= nums[i] <= 10^4`",
                'starter_code_py' => "def maxSubArray(nums):\n    # Write Python solution here\n    return 6\n\nprint(maxSubArray([-2,1,-3,4,-1,2,1,-5,4]))",
                'starter_code_cpp' => "#include <iostream>\n#include <vector>\nusing namespace std;\n\nint maxSubArray(vector<int>& nums) {\n    return 6;\n}\n\nint main() {\n    cout << 6 << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(6);\n    }\n}"
            ],
            [
                'title' => 'Binary Search',
                'slug' => 'binary-search',
                'difficulty' => 'easy',
                'category' => 'Binary Search',
                'description' => "### Problem Statement\nGiven an array of integers `nums` which is sorted in ascending order, and an integer `target`, write a function to search `target` in `nums`. If `target` exists, then return its index. Otherwise, return `-1`.\n\nYou must write an algorithm with `O(log n)` runtime complexity.\n\n### Examples\n**Example 1:**\n* **Input:** `nums = [-1,0,3,5,9,12]`, `target = 9`\n* **Output:** `4`\n* **Explanation:** `9` exists in `nums` and its index is `4`.\n\n**Example 2:**\n* **Input:** `nums = [-1,0,3,5,9,12]`, `target = 2`\n* **Output:** `-1`\n* **Explanation:** `2` does not exist in `nums` so return `-1`.\n\n### Constraints\n* `1 <= nums.length <= 10^4`\n* `-10^4 < nums[i], target < 10^4`\n* All the integers in `nums` are **unique**.\n* `nums` is sorted in ascending order.",
                'starter_code_py' => "def search(nums, target):\n    # Write Python solution here\n    return 4\n\nprint(search([-1,0,3,5,9,12], 9))",
                'starter_code_cpp' => "#include <iostream>\n#include <vector>\nusing namespace std;\n\nint search(vector<int>& nums, int target) {\n    return 4;\n}\n\nint main() {\n    cout << 4 << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(4);\n    }\n}"
            ],
            [
                'title' => 'Fizz Buzz',
                'slug' => 'fizz-buzz',
                'difficulty' => 'easy',
                'category' => 'Math',
                'description' => "### Problem Statement\nGiven an integer `n`, return *a string array answer (1-indexed)* where:\n* `answer[i] == \"FizzBuzz\"` if `i` is divisible by `3` and `5`.\n* `answer[i] == \"Fizz\"` if `i` is divisible by `3`.\n* `answer[i] == \"Buzz\"` if `i` is divisible by `5`.\n* `answer[i] == i` (as a string) if none of the above conditions are true.\n\n### Examples\n**Example 1:**\n* **Input:** `n = 3`\n* **Output:** `[\"1\",\"2\",\"Fizz\"]`\n\n**Example 2:**\n* **Input:** `n = 5`\n* **Output:** `[\"1\",\"2\",\"Fizz\",\"4\",\"Buzz\"]`\n\n**Example 3:**\n* **Input:** `n = 15`\n* **Output:** `[\"1\",\"2\",\"Fizz\",\"4\",\"Buzz\",\"Fizz\",\"7\",\"8\",\"Fizz\",\"Buzz\",\"11\",\"Fizz\",\"13\",\"14\",\"FizzBuzz\"]`\n\n### Constraints\n* `1 <= n <= 10^4`",
                'starter_code_py' => "def fizzBuzz(n):\n    # Write Python solution here\n    return [\"1\", \"2\", \"Fizz\"]\n\nprint(fizzBuzz(3))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << \"[1, 2, Fizz]\" << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(\"[1, 2, Fizz]\");\n    }\n}"
            ],
            [
                'title' => 'Single Number',
                'slug' => 'single-number',
                'difficulty' => 'easy',
                'category' => 'Bit Manipulation',
                'description' => "### Problem Statement\nGiven a **non-empty** array of integers `nums`, every element appears twice except for one. Find that single one.\n\nYou must implement a solution with a linear runtime complexity and use only constant extra space.\n\n### Examples\n**Example 1:**\n* **Input:** `nums = [2,2,1]`\n* **Output:** `1`\n\n**Example 2:**\n* **Input:** `nums = [4,1,2,1,2]`\n* **Output:** `4`\n\n**Example 3:**\n* **Input:** `nums = [1]`\n* **Output:** `1`\n\n### Constraints\n* `1 <= nums.length <= 3 * 10^4`\n* `-3 * 10^4 <= nums[i] <= 3 * 10^4`\n* Each element in the array appears twice except for one element which appears only once.",
                'starter_code_py' => "def singleNumber(nums):\n    # Write Python solution here\n    return 1\n\nprint(singleNumber([2,2,1]))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << 1 << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(1);\n    }\n}"
            ],
            [
                'title' => 'Valid Anagram',
                'slug' => 'valid-anagram',
                'difficulty' => 'easy',
                'category' => 'Hash Table',
                'description' => "### Problem Statement\nGiven two strings `s` and `t`, return `true` if `t` is an **anagram** of `s`, and `false` otherwise.\n\nAn **Anagram** is a word or phrase formed by rearranging the letters of a different word or phrase, typically using all the original letters exactly once.\n\n### Examples\n**Example 1:**\n* **Input:** `s = \"anagram\"`, `t = \"nagaram\"`\n* **Output:** `true`\n\n**Example 2:**\n* **Input:** `s = \"rat\"`, `t = \"car\"`\n* **Output:** `false`\n\n### Constraints\n* `1 <= s.length, t.length <= 5 * 10^4`\n* `s` and `t` consist of lowercase English letters.",
                'starter_code_py' => "def isAnagram(s, t):\n    # Write Python solution here\n    return True\n\nprint(isAnagram(\"anagram\", \"nagaram\"))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << \"true\" << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(\"true\");\n    }\n}"
            ],

            // MEDIUM PROBLEMS (11 to 20)
            [
                'title' => 'Container With Most Water',
                'slug' => 'container-with-most-water',
                'difficulty' => 'medium',
                'category' => 'Two Pointers',
                'description' => "### Problem Statement\nYou are given an integer array `height` of length `n`. There are `n` vertical lines drawn such that the two endpoints of the `i`th line are `(i, 0)` and `(i, height[i])`.\n\nFind two lines that together with the x-axis form a container, such that the container contains the most water.\n\nReturn *the maximum amount of water a container can store*.\n\n**Notice** that you may not slant the container.\n\n### Examples\n**Example 1:**\n* **Input:** `height = [1,8,6,2,5,4,8,3,7]`\n* **Output:** `49`\n* **Explanation:** The above vertical lines are represented by array `[1,8,6,2,5,4,8,3,7]`. In this case, the max area of water the blue section can contain is `49` (height `7` x width `7`).\n\n**Example 2:**\n* **Input:** `height = [1,1]`\n* **Output:** `1`\n\n### Constraints\n* `n == height.length`\n* `2 <= n <= 10^5`\n* `0 <= height[i] <= 10^4`",
                'starter_code_py' => "def maxArea(height):\n    # Write Python solution here\n    return 49\n\nprint(maxArea([1,8,6,2,5,4,8,3,7]))",
                'starter_code_cpp' => "#include <iostream>\n#include <vector>\nusing namespace std;\n\nint maxArea(vector<int>& height) {\n    return 49;\n}\n\nint main() {\n    cout << 49 << endl;\n    return 0;\n}",
                'starter_code_java' => "import java.util.*;\n\nclass Solution {\n    public int maxArea(int[] height) {\n        return 49;\n    }\n    \n    public static void main(String[] args) {\n        System.out.println(49);\n    }\n}"
            ],
            [
                'title' => 'Longest Palindromic Substring',
                'slug' => 'longest-palindromic-substring',
                'difficulty' => 'medium',
                'category' => 'Dynamic Programming',
                'description' => "### Problem Statement\nGiven a string `s`, return *the longest palindromic substring* in `s`.\n\n### Examples\n**Example 1:**\n* **Input:** `s = \"babad\"`\n* **Output:** `\"bab\"`\n* **Explanation:** `\"aba\"` is also a valid answer.\n\n**Example 2:**\n* **Input:** `s = \"cbbd\"`\n* **Output:** `\"bb\"`\n\n### Constraints\n* `1 <= s.length <= 1000`\n* `s` consists of only digits and English letters.",
                'starter_code_py' => "def longestPalindrome(s):\n    return \"bab\"\n\nprint(longestPalindrome(\"babad\"))",
                'starter_code_cpp' => "#include <iostream>\n#include <string>\nusing namespace std;\n\nstring longestPalindrome(string s) {\n    return \"bab\";\n}\n\nint main() {\n    cout << \"bab\" << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(\"bab\");\n    }\n}"
            ],
            [
                'title' => '3Sum',
                'slug' => '3sum',
                'difficulty' => 'medium',
                'category' => 'Two Pointers',
                'description' => "### Problem Statement\nGiven an integer array `nums`, return all the triplets `[nums[i], nums[j], nums[k]]` such that `i != j`, `i != k`, and `j != k`, and `nums[i] + nums[j] + nums[k] == 0`.\n\nNotice that the solution set must not contain duplicate triplets.\n\n### Examples\n**Example 1:**\n* **Input:** `nums = [-1,0,1,2,-1,-4]`\n* **Output:** `[[-1,-1,2],[-1,0,1]]`\n* **Explanation:** \n  * `nums[0] + nums[1] + nums[2] == (-1) + 0 + 1 == 0`.\n  * `nums[1] + nums[2] + nums[4] == 0 + 1 + (-1) == 0`.\n  * `nums[0] + nums[3] + nums[4] == (-1) + 2 + (-1) == 0`.\n  * The distinct triplets are `[-1,0,1]` and `[-1,-1,2]`.\n\n**Example 2:**\n* **Input:** `nums = [0,1,1]`\n* **Output:** `[]`\n* **Explanation:** The only possible triplet does not sum up to `0`.\n\n**Example 3:**\n* **Input:** `nums = [0,0,0]`\n* **Output:** `[[0,0,0]]`\n* **Explanation:** The only possible triplet sums up to `0`.\n\n### Constraints\n* `3 <= nums.length <= 3000`\n* `-10^5 <= nums[i] <= 10^5`",
                'starter_code_py' => "def threeSum(nums):\n    return [[-1,-1,2],[-1,0,1]]\n\nprint(threeSum([-1,0,1,2,-1,-4]))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << \"[[-1,-1,2],[-1,0,1]]\" << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(\"[[-1,-1,2],[-1,0,1]]\");\n    }\n}"
            ],
            [
                'title' => 'Longest Substring Without Repeating Characters',
                'slug' => 'longest-substring-without-repeating-characters',
                'difficulty' => 'medium',
                'category' => 'Sliding Window',
                'description' => "### Problem Statement\nGiven a string `s`, find the length of the **longest substring** without repeating characters.\n\n### Examples\n**Example 1:**\n* **Input:** `s = \"abcabcbb\"`\n* **Output:** `3`\n* **Explanation:** The answer is `\"abc\"`, with the length of `3`.\n\n**Example 2:**\n* **Input:** `s = \"bbbbb\"`\n* **Output:** `1`\n* **Explanation:** The answer is `\"b\"`, with the length of `1`.\n\n**Example 3:**\n* **Input:** `s = \"pwwkew\"`\n* **Output:** `3`\n* **Explanation:** The answer is `\"wke\"`, with the length of `3`. Note that the answer must be a **substring**, `\"pwke\"` is a subsequence and not a substring.\n\n### Constraints\n* `0 <= s.length <= 5 * 10^4`\n* `s` consists of English letters, digits, symbols and spaces.",
                'starter_code_py' => "def lengthOfLongestSubstring(s):\n    return 3\n\nprint(lengthOfLongestSubstring(\"abcabcbb\"))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << 3 << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(3);\n    }\n}"
            ],
            [
                'title' => 'Add Two Numbers',
                'slug' => 'add-two-numbers',
                'difficulty' => 'medium',
                'category' => 'Linked List',
                'description' => "### Problem Statement\nYou are given two **non-empty** linked lists representing two non-negative integers. The digits are stored in **reverse order**, and each of their nodes contains a single digit. Add the two numbers and return the sum as a linked list.\n\nYou may assume the two numbers do not contain any leading zero, except the number `0` itself.\n\n### Examples\n**Example 1:**\n* **Input:** `l1 = [2,4,3]`, `l2 = [5,6,4]`\n* **Output:** `[7,0,8]`\n* **Explanation:** `342 + 465 = 807`.\n\n**Example 2:**\n* **Input:** `l1 = [0]`, `l2 = [0]`\n* **Output:** `[0]`\n\n**Example 3:**\n* **Input:** `l1 = [9,9,9,9,9,9,9]`, `l2 = [9,9,9,9]`\n* **Output:** `[8,9,9,9,0,0,0,1]`\n\n### Constraints\n* The number of nodes in each linked list is in the range `[1, 100]`.\n* `0 <= Node.val <= 9`\n* It is guaranteed that the list represents a number that does not have leading zeros.",
                'starter_code_py' => "def addTwoNumbers(l1, l2):\n    return [7,0,8]\n\nprint(addTwoNumbers([2,4,3], [5,6,4]))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << \"[7, 0, 8]\" << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(\"[7, 0, 8]\");\n    }\n}"
            ],
            [
                'title' => 'Group Anagrams',
                'slug' => 'group-anagrams',
                'difficulty' => 'medium',
                'category' => 'Hash Table',
                'description' => "### Problem Statement\nGiven an array of strings `strs`, group the **anagrams** together. You can return the answer in any order.\n\nAn **Anagram** is a word or phrase formed by rearranging the letters of a different word or phrase, typically using all the original letters exactly once.\n\n### Examples\n**Example 1:**\n* **Input:** `strs = [\"eat\",\"tea\",\"tan\",\"ate\",\"nat\",\"bat\"]`\n* **Output:** `[[\"bat\"],[\"nat\",\"tan\"],[\"ate\",\"eat\",\"tea\"]]`\n\n**Example 2:**\n* **Input:** `strs = [\"\"]`\n* **Output:** `[[\"\"]]`\n\n**Example 3:**\n* **Input:** `strs = [\"a\"]`\n* **Output:** `[[\"a\"]]`\n\n### Constraints\n* `1 <= strs.length <= 10^4`\n* `0 <= strs[i].length <= 100`\n* `strs[i]` consists of lowercase English letters.",
                'starter_code_py' => "def groupAnagrams(strs):\n    return [[\"bat\"],[\"nat\",\"tan\"],[\"ate\",\"eat\",\"tea\"]]\n\nprint(groupAnagrams([\"eat\",\"tea\",\"tan\",\"ate\",\"nat\",\"bat\"]))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << \"[[\" << \"\\\"bat\\\"\" << \"],[\" << \"\\\"nat\\\",\\\"tan\\\"\" << \"],[\" << \"\\\"ate\\\",\\\"eat\\\",\\\"tea\\\"\" << \"]]\" << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(\"[[\\\"bat\\\"],[\\\"nat\\\",\\\"tan\\\"],[\\\"ate\\\",\\\"eat\\\",\\\"tea\\\"]]\");\n    }\n}"
            ],
            [
                'title' => 'Product of Array Except Self',
                'slug' => 'product-of-array-except-self',
                'difficulty' => 'medium',
                'category' => 'Array',
                'description' => "### Problem Statement\nGiven an integer array `nums`, return *an array* `answer` *such that* `answer[i]` *is equal to the product of all the elements of* `nums` *except* `nums[i]`.\n\nThe product of any prefix or suffix of `nums` is guaranteed to fit in a 32-bit integer.\n\nYou must write an algorithm that runs in `O(n)` time and without using the division operation.\n\n### Examples\n**Example 1:**\n* **Input:** `nums = [1,2,3,4]`\n* **Output:** `[24,12,8,6]`\n\n**Example 2:**\n* **Input:** `nums = [-1,1,0,-3,3]`\n* **Output:** `[0,0,9,0,0]`\n\n### Constraints\n* `2 <= nums.length <= 10^5`\n* `-30 <= nums[i] <= 30`\n* The product of any prefix or suffix of `nums` is guaranteed to fit in a 32-bit integer.",
                'starter_code_py' => "def productExceptSelf(nums):\n    return [24,12,8,6]\n\nprint(productExceptSelf([1,2,3,4]))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << \"[24, 12, 8, 6]\" << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(\"[24, 12, 8, 6]\");\n    }\n}"
            ],
            [
                'title' => 'Generate Parentheses',
                'slug' => 'generate-parentheses',
                'difficulty' => 'medium',
                'category' => 'Backtracking',
                'description' => "### Problem Statement\nGiven `n` pairs of parentheses, write a function to *generate all combinations of well-formed parentheses*.\n\n### Examples\n**Example 1:**\n* **Input:** `n = 3`\n* **Output:** `[\"((()))\",\"(()())\",\"(())()\",\"()(())\",\"()()()\"]`\n\n**Example 2:**\n* **Input:** `n = 1`\n* **Output:** `[\"()\"]`\n\n### Constraints\n* `1 <= n <= 8`",
                'starter_code_py' => "def generateParenthesis(n):\n    return [\"((()))\",\"(()())\",\"(())()\",\"()(())\",\"()()()\"]\n\nprint(generateParenthesis(3))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << \"[\\\"((()))\\\",\\\"(()())\\\",\\\"(())()\\\",\\\"()(())\\\",\\\"()()()\\\"]\" << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(\"[\\\"((()))\\\",\\\"(()())\\\",\\\"(())()\\\",\\\"()(())\\\",\\\"()()()\\\"]\");\n    }\n}"
            ],
            [
                'title' => 'Kth Largest Element in an Array',
                'slug' => 'kth-largest-element-in-an-array',
                'difficulty' => 'medium',
                'category' => 'Heap',
                'description' => "### Problem Statement\nGiven an integer array `nums` and an integer `k`, return *the* `k`th *largest element in the array*.\n\nNote that it is the `k`th largest element in the sorted order, not the `k`th distinct element.\n\nCan you solve it without sorting in `O(n)` time?\n\n### Examples\n**Example 1:**\n* **Input:** `nums = [3,2,1,5,6,4]`, `k = 2`\n* **Output:** `5`\n\n**Example 2:**\n* **Input:** `nums = [3,2,3,1,2,4,5,5,6]`, `k = 4`\n* **Output:** `4`\n\n### Constraints\n* `1 <= k <= nums.length <= 10^5`\n* `-10^4 <= nums[i] <= 10^4`",
                'starter_code_py' => "def findKthLargest(nums, k):\n    return 5\n\nprint(findKthLargest([3,2,1,5,6,4], 2))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << 5 << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(5);\n    }\n}"
            ],
            [
                'title' => 'Subarray Sum Equals K',
                'slug' => 'subarray-sum-equals-k',
                'difficulty' => 'medium',
                'category' => 'Prefix Sum',
                'description' => "### Problem Statement\nGiven an array of integers `nums` and an integer `k`, return *the total number of subarrays whose sum equals to* `k`.\n\nA subarray is a contiguous non-empty sequence of elements within an array.\n\n### Examples\n**Example 1:**\n* **Input:** `nums = [1,1,1]`, `k = 2`\n* **Output:** `2`\n\n**Example 2:**\n* **Input:** `nums = [1,2,3]`, `k = 3`\n* **Output:** `2`\n\n### Constraints\n* `1 <= nums.length <= 2 * 10^4`\n* `-1000 <= nums[i] <= 1000`\n* `-10^7 <= k <= 10^7`",
                'starter_code_py' => "def subarraySum(nums, k):\n    return 2\n\nprint(subarraySum([1,1,1], 2))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << 2 << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(2);\n    }\n}"
            ],

            // HARD PROBLEMS (21 to 30)
            [
                'title' => 'Median of Two Sorted Arrays',
                'slug' => 'median-of-two-sorted-arrays',
                'difficulty' => 'hard',
                'category' => 'Binary Search',
                'description' => "### Problem Statement\nGiven two sorted arrays `nums1` and `nums2` of size `m` and `n` respectively, return **the median** of the two sorted arrays.\n\nThe overall run time complexity should be `O(log (m+n))`.\n\n### Examples\n**Example 1:**\n* **Input:** `nums1 = [1,3]`, `nums2 = [2]`\n* **Output:** `2.00000`\n* **Explanation:** merged array = `[1,2,3]` and median is `2`.\n\n**Example 2:**\n* **Input:** `nums1 = [1,2]`, `nums2 = [3,4]`\n* **Output:** `2.50000`\n* **Explanation:** merged array = `[1,2,3,4]` and median is `(2 + 3) / 2 = 2.5`.\n\n### Constraints\n* `nums1.length == m`\n* `nums2.length == n`\n* `0 <= m, n <= 1000`\n* `1 <= m + n <= 2000`\n* `-10^6 <= nums1[i], nums2[i] <= 10^6`",
                'starter_code_py' => "def findMedianSortedArrays(nums1, nums2):\n    return 2.0\n\nprint(findMedianSortedArrays([1,3], [2]))",
                'starter_code_cpp' => "#include <iostream>\n#include <vector>\nusing namespace std;\n\ndouble findMedianSortedArrays(vector<int>& nums1, vector<int>& nums2) {\n    return 2.0;\n}\n\nint main() {\n    cout << 2.0 << endl;\n    return 0;\n}",
                'starter_code_java' => "import java.util.*;\n\nclass Solution {\n    public double findMedianSortedArrays(int[] nums1, int[] nums2) {\n        return 2.0;\n    }\n    \n    public static void main(String[] args) {\n        System.out.println(2.0);\n    }\n}"
            ],
            [
                'title' => 'Merge k Sorted Lists',
                'slug' => 'merge-k-sorted-lists',
                'difficulty' => 'hard',
                'category' => 'Linked List',
                'description' => "### Problem Statement\nYou are given an array of `k` linked-lists `lists`, each linked-list is sorted in ascending order.\n\n*Merge all the linked-lists into one sorted linked-list and return it.*\n\n### Examples\n**Example 1:**\n* **Input:** `lists = [[1,4,5],[1,3,4],[2,6]]`\n* **Output:** `[1,1,2,3,4,4,5,6]`\n* **Explanation:** The linked-lists are:\n  * `1 -> 4 -> 5`,\n  * `1 -> 3 -> 4`,\n  * `2 -> 6`\n  * merging them into one sorted list:\n  * `1 -> 1 -> 2 -> 3 -> 4 -> 4 -> 5 -> 6`.\n\n**Example 2:**\n* **Input:** `lists = []`\n* **Output:** `[]`\n\n**Example 3:**\n* **Input:** `lists = [[]]`\n* **Output:** `[]`\n\n### Constraints\n* `k == lists.length`\n* `0 <= k <= 10^4`\n* `0 <= lists[i].length <= 500`\n* `-10^4 <= lists[i][j] <= 10^4`\n* `lists[i]` is sorted in ascending order.\n* The sum of `lists[i].length` will not exceed `10^4`.",
                'starter_code_py' => "def mergeKLists(lists):\n    return [1,1,2,3,4,4,5,6]\n\nprint(mergeKLists([[1,4,5],[1,3,4],[2,6]]))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << \"[1, 1, 2, 3, 4, 4, 5, 6]\" << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(\"[1, 1, 2, 3, 4, 4, 5, 6]\");\n    }\n}"
            ],
            [
                'title' => 'Trapping Rain Water',
                'slug' => 'trapping-rain-water',
                'difficulty' => 'hard',
                'category' => 'Two Pointers',
                'description' => "### Problem Statement\nGiven `n` non-negative integers representing an elevation map where the width of each bar is `1`, compute how much water it can trap after raining.\n\n### Examples\n**Example 1:**\n* **Input:** `height = [0,1,0,2,1,0,1,3,2,1,2,1]`\n* **Output:** `6`\n* **Explanation:** The above elevation map (black section) is represented by array `[0,1,0,2,1,0,1,3,2,1,2,1]`. In this case, `6` units of rain water (blue section) are being trapped.\n\n**Example 2:**\n* **Input:** `height = [4,2,0,3,2,5]`\n* **Output:** `9`\n\n### Constraints\n* `n == height.length`\n* `1 <= n <= 2 * 10^4`\n* `0 <= height[i] <= 10^5`",
                'starter_code_py' => "def trap(height):\n    return 6\n\nprint(trap([0,1,0,2,1,0,1,3,2,1,2,1]))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << 6 << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(6);\n    }\n}"
            ],
            [
                'title' => 'Edit Distance',
                'slug' => 'edit-distance',
                'difficulty' => 'hard',
                'category' => 'Dynamic Programming',
                'description' => "### Problem Statement\nGiven two strings `word1` and `word2`, return *the minimum number of operations required to convert `word1` to `word2`*.\n\nYou have the following three operations permitted on a word:\n1. Insert a character\n2. Delete a character\n3. Replace a character\n\n### Examples\n**Example 1:**\n* **Input:** `word1 = \"horse\"`, `word2 = \"ros\"`\n* **Output:** `3`\n* **Explanation:** \n  * `horse` -> `rorse` (replace `'h'` with `'r'`)\n  * `rorse` -> `rose` (remove `'r'`)\n  * `rose` -> `ros` (remove `'e'`)\n\n**Example 2:**\n* **Input:** `word1 = \"intention\"`, `word2 = \"execution\"`\n* **Output:** `5`\n* **Explanation:** \n  * `intention` -> `inention` (remove `'t'`)\n  * `inention` -> `enention` (replace `'i'` with `'e'`)\n  * `enention` -> `exention` (replace `'n'` with `'x'`)\n  * `exention` -> `exection` (replace `'n'` with `'c'`)\n  * `exection` -> `execution` (insert `'u'`)\n\n### Constraints\n* `0 <= word1.length, word2.length <= 500`\n* `word1` and `word2` consist of lowercase English letters.",
                'starter_code_py' => "def minDistance(word1, word2):\n    return 3\n\nprint(minDistance(\"horse\", \"ros\"))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << 3 << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(3);\n    }\n}"
            ],
            [
                'title' => 'N-Queens',
                'slug' => 'n-queens',
                'difficulty' => 'hard',
                'category' => 'Backtracking',
                'description' => "### Problem Statement\nThe **n-queens** puzzle is the problem of placing `n` queens on an `n x n` chessboard such that no two queens attack each other.\n\nGiven an integer `n`, return *all distinct solutions to the **n-queens puzzle***. You may return the answer in **any order**.\n\nEach solution contains a distinct board configuration of the n-queens' placement, where `'Q'` and `'.'` both indicate a queen and an empty space, respectively.\n\n### Examples\n**Example 1:**\n* **Input:** `n = 4`\n* **Output:** `[[\".Q..\",\"...Q\",\"Q...\",\"..Q.\"],[\"..Q.\",\"Q...\",\"...Q\",\".Q..\"]]`\n* **Explanation:** There exist two distinct solutions to the 4-queens puzzle as shown above.\n\n**Example 2:**\n* **Input:** `n = 1`\n* **Output:** `[[\"Q\"]]`\n\n### Constraints\n* `1 <= n <= 9`",
                'starter_code_py' => "def solveNQueens(n):\n    return [[\".Q..\",\"...Q\",\"Q...\",\"..Q.\"],[\"..Q.\",\"Q...\",\"...Q\",\".Q..\"]]\n\nprint(solveNQueens(4))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << \"[[.Q.., ...Q, Q..., ..Q.], [..Q., Q..., ...Q, .Q..]]\" << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(\"[[.Q.., ...Q, Q..., ..Q.], [..Q., Q..., ...Q, .Q..]]\");\n    }\n}"
            ],
            [
                'title' => 'First Missing Positive',
                'slug' => 'first-missing-positive',
                'difficulty' => 'hard',
                'category' => 'Array',
                'description' => "### Problem Statement\nGiven an unsorted integer array `nums`, return the smallest missing positive integer.\n\nYou must implement an algorithm that runs in `O(n)` time and uses `O(1)` auxiliary space.\n\n### Examples\n**Example 1:**\n* **Input:** `nums = [1,2,0]`\n* **Output:** `3`\n* **Explanation:** The numbers in the range [1,2] are all in the array. The smallest missing positive integer is 3.\n\n**Example 2:**\n* **Input:** `nums = [3,4,-1,1]`\n* **Output:** `2`\n* **Explanation:** 1 is in the array but 2 is missing.\n\n**Example 3:**\n* **Input:** `nums = [7,8,9,11,12]`\n* **Output:** `1`\n* **Explanation:** The smallest positive integer 1 is missing.\n\n### Constraints\n* `1 <= nums.length <= 10^5`\n* `-2^31 <= nums[i] <= 2^31 - 1`",
                'starter_code_py' => "def firstMissingPositive(nums):\n    return 3\n\nprint(firstMissingPositive([1,2,0]))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << 3 << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(3);\n    }\n}"
            ],
            [
                'title' => 'Sliding Window Maximum',
                'slug' => 'sliding-window-maximum',
                'difficulty' => 'hard',
                'category' => 'Deque',
                'description' => "### Problem Statement\nYou are given an array of integers `nums`, there is a sliding window of size `k` which is moving from the very left of the array to the very right. You can only see the `k` numbers in the window. Each time the sliding window moves right by one position.\n\nReturn *the max sliding window*.\n\n### Examples\n**Example 1:**\n* **Input:** `nums = [1,3,-1,-3,5,3,6,7]`, `k = 3`\n* **Output:** `[3,3,5,5,6,7]`\n* **Explanation:** \n```\nWindow position                Max\n---------------               -----\n[1  3  -1] -3  5  3  6  7       3\n 1 [3  -1  -3] 5  3  6  7       3\n 1  3 [-1  -3  5] 3  6  7       5\n 1  3  -1 [-3  5  3] 6  7       5\n 1  3  -1  -3 [5  3  6] 7       6\n 1  3  -1  -3  5 [3  6  7]      7\n```\n\n**Example 2:**\n* **Input:** `nums = [1]`, `k = 1`\n* **Output:** `[1]`\n\n### Constraints\n* `1 <= nums.length <= 10^5`\n* `-10^4 <= nums[i] <= 10^4`\n* `1 <= k <= nums.length`",
                'starter_code_py' => "def maxSlidingWindow(nums, k):\n    return [3,3,5,5,6,7]\n\nprint(maxSlidingWindow([1,3,-1,-3,5,3,6,7], 3))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << \"[3, 3, 5, 5, 6, 7]\" << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(\"[3, 3, 5, 5, 6, 7]\");\n    }\n}"
            ],
            [
                'title' => 'Reverse Nodes in k-Group',
                'slug' => 'reverse-nodes-in-k-group',
                'difficulty' => 'hard',
                'category' => 'Linked List',
                'description' => "### Problem Statement\nGiven the head of a linked list, reverse the nodes of the list `k` at a time, and return *the modified list*.\n\n`k` is a positive integer and is less than or equal to the length of the linked list. If the number of nodes is not a multiple of `k` then left-out nodes, in the end, should remain as they are.\n\nYou may not alter the values in the list's nodes, only nodes themselves may be changed.\n\n### Examples\n**Example 1:**\n* **Input:** `head = [1,2,3,4,5]`, `k = 2`\n* **Output:** `[2,1,4,3,5]`\n\n**Example 2:**\n* **Input:** `head = [1,2,3,4,5]`, `k = 3`\n* **Output:** `[3,2,1,4,5]`\n\n### Constraints\n* The number of nodes in the list is `n`.\n* `1 <= k <= n <= 5000`\n* `0 <= Node.val <= 1000`",
                'starter_code_py' => "def reverseKGroup(head, k):\n    return [2,1,4,3,5]\n\nprint(reverseKGroup([1,2,3,4,5], 2))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << \"[2, 1, 4, 3, 5]\" << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(\"[2, 1, 4, 3, 5]\");\n    }\n}"
            ],
            [
                'title' => 'Regular Expression Matching',
                'slug' => 'regular-expression-matching',
                'difficulty' => 'hard',
                'category' => 'Dynamic Programming',
                'description' => "### Problem Statement\nGiven an input string `s` and a pattern `p`, implement regular expression matching with support for `'.'` and `'*'` where:\n* `'.'` Matches any single character.\n* `'*'` Matches zero or more of the preceding element.\n\nThe matching should cover the **entire** input string (not partial).\n\n### Examples\n**Example 1:**\n* **Input:** `s = \"aa\"`, `p = \"a\"`\n* **Output:** `false`\n* **Explanation:** `\"a\"` does not match the entire string `\"aa\"`.\n\n**Example 2:**\n* **Input:** `s = \"aa\"`, `p = \"a*\"`\n* **Output:** `true`\n* **Explanation:** `'*'` means zero or more of the preceding element, `'a'`. Therefore, by repeating `'a'` once, it becomes `\"aa\"`.\n\n**Example 3:**\n* **Input:** `s = \"ab\"`, `p = \".*\"`\n* **Output:** `true`\n* **Explanation:** `\".*\"` means \"zero or more of any character\".\n\n### Constraints\n* `1 <= s.length <= 20`\n* `1 <= p.length <= 20`\n* `s` contains only lowercase English letters.\n* `p` contains only lowercase English letters, `'.'`, and `'*'`. \n* It is guaranteed for each appearance of the character `'*'`, there will be a previous valid character to match.",
                'starter_code_py' => "def isMatch(s, p):\n    return True\n\nprint(isMatch(\"aa\", \"a*\"))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << \"true\" << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(\"true\");\n    }\n}"
            ],
            [
                'title' => 'Minimum Window Substring',
                'slug' => 'minimum-window-substring',
                'difficulty' => 'hard',
                'category' => 'Sliding Window',
                'description' => "### Problem Statement\nGiven two strings `s` and `t` of lengths `m` and `n` respectively, return *the **minimum window substring** of* `s` *such that every character in* `t` *(**including duplicates**) is included in the window*. If there is no such substring, return the empty string `\"\"`.\n\nThe test cases will be generated such that the answer is **unique**.\n\n### Examples\n**Example 1:**\n* **Input:** `s = \"ADOBECODEBANC\"`, `t = \"ABC\"`\n* **Output:** `\"BANC\"`\n* **Explanation:** The minimum window substring `\"BANC\"` includes `'A'`, `'B'`, and `'C'` from string `t`.\n\n**Example 2:**\n* **Input:** `s = \"a\"`, `t = \"a\"`\n* **Output:** `\"a\"`\n* **Explanation:** The entire string `\"a\"` is the minimum window.\n\n**Example 3:**\n* **Input:** `s = \"a\"`, `t = \"aa\"`\n* **Output:** `\"\"`\n* **Explanation:** Both `'a'`s must be included in the window. Since the window is of size 1 and only has 1 `'a'`, it is impossible, hence we return `\"\"`.\n\n### Constraints\n* `m == s.length`\n* `n == t.length`\n* `1 <= m, n <= 10^5`\n* `s` and `t` consist of uppercase and lowercase English letters.",
                'starter_code_py' => "def minWindow(s, t):\n    return \"BANC\"\n\nprint(minWindow(\"ADOBECODEBANC\", \"ABC\"))",
                'starter_code_cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << \"BANC\" << endl;\n    return 0;\n}",
                'starter_code_java' => "class Solution {\n    public static void main(String[] args) {\n        System.out.println(\"BANC\");\n    }\n}"
            ]
        ];

        foreach ($problems as $prob) {
            PracticeProblem::create($prob);
        }
    }
}
