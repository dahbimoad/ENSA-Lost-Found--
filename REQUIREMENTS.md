# ENSA Agadir Lost & Found Platform - Project Requirements

## Project Overview
A web platform for ENSA Agadir students to report lost items and found items, facilitating the reunion of students with their belongings.

## Tech Stack
- **Frontend**: Laravel Blade + Livewire 3
- **Backend**: Laravel 10+ (PHP 8.1+)
- **Database**: MySQL 8.0+
- **Authentication**: Laravel Breeze/Jetstream
- **File Storage**: Laravel Storage (local/cloud)
- **Styling**: Tailwind CSS + Alpine.js
- **Real-time**: Livewire for dynamic interactions

## Core Features

### 1. User Authentication & Authorization
- **Student Registration**: Email verification required
- **Login/Logout**: Secure authentication
- **Password Reset**: Email-based recovery
- **Profile Management**: Update personal information
- **Role-based Access**: Student, Admin

### 2. Item Management

#### Lost Items
- **Report Lost Item**:
  - Item title/name
  - Detailed description
  - Category (Electronics, Books, Clothing, Accessories, Documents, Other)
  - Last seen location on campus
  - Date/time lost
  - Contact information
  - Reward offered (optional)
  - Upload reference image (optional)

#### Found Items
- **Report Found Item**:
  - Item title/name
  - Detailed description
  - Category
  - Location found
  - Date/time found
  - Current location/storage
  - Contact information
  - Upload item photo

### 3. Search & Browse
- **Advanced Search**:
  - Text search (title, description)
  - Filter by category
  - Filter by date range
  - Filter by location
  - Filter by status (active, resolved)
- **Browse Categories**: Organized item listings
- **Recent Items**: Latest lost/found posts
- **Map Integration**: Campus location markers (optional)

### 4. Communication
- **Direct Email Contact**: Click to send email to item owner
- **WhatsApp Integration**: One-click WhatsApp message
- **Phone Contact**: Direct phone number display (optional)
- **Contact Privacy**: Show/hide contact methods per user preference

### 5. Item Status Management
- **Mark as Resolved**: When item is returned
- **Auto-expire**: Remove old posts (after 60 days)
- **Status Updates**: Progress tracking
- **Verification System**: Confirm legitimate returns

### 6. Admin Panel
- **User Management**: View, suspend, delete users
- **Content Management**: View, delete inappropriate posts
- **Analytics Dashboard**: Usage statistics
- **System Settings**: Configure categories, locations
- **Reports**: Generate usage reports

## Technical Requirements

### Backend (Laravel)

#### Database Schema
```sql
-- Users table (extends Laravel's default)
users: id, name, email, student_id, phone, whatsapp, year, department, 
       show_email, show_phone, show_whatsapp, is_admin, verified_at

-- Items table
items: id, user_id, type(lost/found), title, description, category_id, 
       location, date_occurred, reward, status(active/resolved), image_path, 
       created_at, updated_at, expires_at

-- Categories table
categories: id, name, icon, description

-- Locations table
locations: id, name, building, floor, description
```

#### API Endpoints
```php
// Web Routes (Blade views)
GET / (homepage)
GET /items (browse items)
GET /items/create (post item form)
POST /items (store item)
GET /items/{id} (item details)
DELETE /items/{id} (delete own item)
GET /profile (user profile)
GET /admin (admin dashboard - admin only)
DELETE /admin/items/{id} (admin delete any item)
GET /admin/users (admin user management)

// Livewire Components
ItemsList (dynamic filtering/search)
ItemForm (reactive form validation)
ContactModal (contact interaction)
AdminDashboard (real-time stats)
AdminUserManager (user management)
```

#### Key Laravel Features to Use
- **Blade Templates**: Server-side rendering
- **Livewire Components**: Dynamic interactions
- **Form Requests**: Validation
- **Middleware**: Authentication, rate limiting
- **Jobs & Queues**: Email notifications
- **Storage**: File uploads
- **Policies**: Authorization
- **Observers**: Auto-expire items
- **Gates**: Admin access control

### Frontend (Blade + Livewire)

#### File Structure
```
resources/
├── views/
│   ├── layouts/
│   │   ├── app.blade.php
│   │   └── guest.blade.php
│   ├── components/
│   │   ├── item-card.blade.php
│   │   ├── search-bar.blade.php
│   │   └── contact-buttons.blade.php
│   ├── livewire/
│   │   ├── items-list.blade.php
│   │   ├── item-form.blade.php
│   │   ├── admin-dashboard.blade.php
│   │   ├── admin-user-manager.blade.php
│   │   └── contact-modal.blade.php
│   ├── items/
│   │   ├── index.blade.php
│   │   ├── show.blade.php
│   │   └── create.blade.php
│   └── auth/
│       ├── login.blade.php
│       └── register.blade.php
app/
└── Livewire/
    ├── ItemsList.php
    ├── ItemForm.php
    ├── AdminDashboard.php
    ├── AdminUserManager.php
    └── ContactModal.php
```

## Non-Functional Requirements

### Performance
- Page load time < 3 seconds
- API response time < 500ms
- Support 100+ concurrent users
- Optimized images (WebP format)

### Security
- HTTPS encryption
- Input validation & sanitization
- CSRF protection
- Rate limiting
- File upload restrictions
- User data privacy

### Usability
- Mobile-responsive design
- Intuitive navigation
- Accessibility (WCAG 2.1)
- Multi-language support (Arabic, French, English)
- Offline functionality (basic browsing)

### Reliability
- 99% uptime
- Automated backups
- Error logging
- Graceful error handling

## Development Timeline

### Phase 1 (Week 1-2): Backend Setup
- Laravel installation & configuration
- Database design & migrations
- Authentication setup (Breeze/Jetstream)
- Basic CRUD operations

### Phase 2 (Week 3-4): Core Features
- Item posting functionality
- Search & filtering with Livewire
- User management
- File upload system
- Contact integration (email/WhatsApp)

### Phase 3 (Week 5-6): Frontend Development
- Blade templates & layouts
- Livewire components
- Tailwind CSS styling
- Contact buttons implementation

### Phase 4 (Week 7-8): Advanced Features
- Admin panel with Livewire
- User management (admin only)
- Email notifications
- Contact logging & analytics
- Testing & bug fixes

### Phase 5 (Week 9-10): Deployment & Polish
- Production deployment
- Performance optimization
- Documentation
- User training

## Deployment Requirements

### Server Specifications
- PHP 8.1+
- MySQL 8.0+
- Nginx/Apache
- SSL Certificate
- 2GB RAM minimum
- 20GB storage

### Hosting Options
- **Shared Hosting**: Any PHP hosting ($1-5/month)
- **VPS**: DigitalOcean, Linode ($5-10/month)
- **Cloud**: AWS, Google Cloud
- **Free Option**: Railway, Render, InfinityFree

## Success Metrics
- 50+ active users within first month
- 100+ items posted
- 70% resolution rate for lost items
- <24 hour average response time
- 4.5+ star user rating

## Future Enhancements
- Mobile app (React Native)
- Real-time notifications (WebSockets)
- Campus map integration
- QR code generation for items
- Integration with university systems
- AI-powered item matching

---

**Project Duration**: 10 weeks  
**Team Size**: 1-2 developers  
**Budget**: $50-100 (hosting + domain)  
**Target Users**: ENSA Agadir students (~2000 students)

## Contact Integration Implementation

### Livewire Contact Component
```php
// app/Livewire/ContactModal.php
class ContactModal extends Component
{
    public Item $item;
    public $showModal = false;
    
    public function contact($type)
    {
        // Log contact attempt
        ContactLog::create([
            'item_id' => $this->item->id,
            'contacter_id' => auth()->id(),
            'contact_type' => $type,
        ]);
        
        $this->dispatch('contact-logged', $type);
    }
    
    public function render()
    {
        return view('livewire.contact-modal');
    }
}
```

### Blade Contact Buttons
```blade
{{-- resources/views/components/contact-buttons.blade.php --}}
@props(['item'])

<div class="contact-buttons space-x-2">
    @if($item->user->show_email && $item->user->email)
        <a href="mailto:{{ $item->user->email }}?subject=About: {{ $item->title }}"
           class="btn btn-primary">
            📧 Send Email
        </a>
    @endif
    
    @if($item->user->show_whatsapp && $item->user->whatsapp)
        <a href="https://wa.me/{{ $item->user->whatsapp }}?text=Hi, about your item: {{ $item->title }}"
           target="_blank" class="btn btn-success">
            � WhatsApp
        </a>
    @endif
    
    @if($item->user->show_phone && $item->user->phone)
        <a href="tel:{{ $item->user->phone }}" class="btn btn-secondary">
            📞 Call
        </a>
    @endif
</div>
```

## Simple Authorization Implementation

### Admin Check
```php
// app/Providers/AuthServiceProvider.php
Gate::define('admin', function ($user) {
    return $user->is_admin;
});

// In controllers/middleware
public function __construct()
{
    $this->middleware('auth');
    $this->middleware('can:admin')->only(['adminDashboard', 'manageUsers']);
}
```

### Item Ownership Policy
```php
// app/Policies/ItemPolicy.php
class ItemPolicy
{
    public function delete(User $user, Item $item)
    {
        return $user->id === $item->user_id || $user->is_admin;
    }
    
    public function update(User $user, Item $item)
    {
        return $user->id === $item->user_id;
    }
}
```

### Blade Authorization
```blade
{{-- Only show delete button to owner or admin --}}
@can('delete', $item)
    <button wire:click="deleteItem({{ $item->id }})" class="btn btn-danger">
        Delete Item
    </button>
@endcan

{{-- Admin only sections --}}
@can('admin')
    <a href="{{ route('admin.dashboard') }}" class="nav-link">Admin Panel</a>
@endcan
```
