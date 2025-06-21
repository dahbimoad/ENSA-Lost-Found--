<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use App\Models\Item;

class NewItemPosted extends Notification
{
    use Queueable;

    protected $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $itemType = $this->item->type === 'lost' ? 'Lost' : 'Found';
        
        return (new MailMessage)
                    ->subject("New {$itemType} Item Posted: {$this->item->title}")
                    ->greeting("Hello {$notifiable->name}!")
                    ->line("A new {$itemType} item has been posted that might interest you.")
                    ->line("**Item:** {$this->item->title}")
                    ->line("**Category:** {$this->item->category->name}")
                    ->line("**Location:** " . ($this->item->location ?? 'Not specified'))
                    ->line("**Description:** " . Str::limit($this->item->description, 100))
                    ->action('View Item Details', route('items.show', $this->item))
                    ->line('Thank you for using our Lost & Found platform!');
    }

    public function toArray($notifiable)
    {
        return [
            'item_id' => $this->item->id,
            'item_title' => $this->item->title,
            'item_type' => $this->item->type,
            'posted_by' => $this->item->user->name,
        ];
    }
}
