<?php

namespace App\Mail\Users;

use App\Models\Post;
use App\Models\Post\PostComment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyComment extends Mailable
{
    use Queueable, SerializesModels;
    
    public $post;
    public $commentParent;
    public $commentChild;
    public $newCommentId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post, PostComment $commentParent, PostComment $commentChild, $newCommentId)
    {
        
        $this->post = $post;
        $this->commentParent = $commentParent;
        $this->commentChild = $commentChild;
        $this->newCommentId = $newCommentId;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Notify Comment - Dinner with Roberto',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.users.notify_comment',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
