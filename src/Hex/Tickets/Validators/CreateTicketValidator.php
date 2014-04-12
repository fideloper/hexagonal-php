<?php  namespace Hex\Tickets\Validators; 

use Hex\Core\ValidationException;
use Hex\Core\ValidatorInterface;
use Illuminate\Validation\Factory;

class CreateTicketValidator implements ValidatorInterface {

    /**
     * @var \Illuminate\Validation\Factory
     */
    private $validator;

    /**
     * @var array
     */
    protected $rules = [
        'subject' => 'required',
        'name' => 'required',
        'email' => 'required|email',
        'category_id' => 'required',
        'staffer_id' => 'required',
        'message' => 'required',
    ];

    public function __construct(Factory $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param $command
     * @throws \Hex\Core\ValidationException
     */
    public function validate($command)
    {
        $validator = $this->validator->make([
            'subject' => $command->subject,
            'name' => $command->name,
            'email' => $command->email,
            'category_id' => $command->category->id,
            'staffer_id' => $command->staffer->id,
            'message' => $command->message, // Uses __toString()
        ], $this->rules);

        if( ! $validator->passes() )
        {
            throw new ValidationException( $validator->errors() );
        }
    }
}