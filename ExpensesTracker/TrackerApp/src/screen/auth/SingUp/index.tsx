import {
  View,
  Text,
  ImageBackground,
  KeyboardAvoidingView,
  Platform,
  ScrollView,
  TouchableOpacity,
  ViewStyle,
  TextStyle,
} from 'react-native';
import React from 'react';
import {useForm, Controller, SubmitHandler} from 'react-hook-form';
import AuthHeader from '../../../components/core/AuthHeader';
import {createStyles} from './styles';
import ButtonIconComponent from '../../../components/core/ButtonIcon';
import Input from '../../../components/core/Input';
import BackgroundWrapper from '../../../components/BackgroundWrapper';

interface FormData {
  fullName: string;
  address: string;
  email: string;
  phone: string;
  password: string;
  confirmPassword: string;
}

interface InputProps {
  value: string;
  onChangeText: (text: string) => void;
  placeholder: string;
  error?: string;
  secureTextEntry?: boolean;
}

interface SignUpProps {
  navigation: {
    replace: (screen: string) => void;
  };
}

const SignUp: React.FC<SignUpProps> = ({navigation}) => {
  const styles = createStyles();

  const {
    control,
    handleSubmit,
    formState: {errors},
    watch,
  } = useForm<FormData>({
    defaultValues: {
      fullName: '',
      address: '',
      email: '',
      phone: '',
      password: '',
      confirmPassword: '',
    },
  });

  const onSubmit: SubmitHandler<FormData> = (data: FormData): void => {
    console.log(data);
  };

  const formFields: Array<{
    name: keyof FormData;
    placeholder: string;
    rules: Object;
    secureTextEntry?: boolean;
  }> = [
    {
      name: 'fullName',
      placeholder: 'Full name',
      rules: {required: 'Full name is required'},
    },
    {
      name: 'address',
      placeholder: 'Address',
      rules: {required: 'Address is required'},
    },
    {
      name: 'email',
      placeholder: 'Email',
      rules: {
        required: 'Email is required',
        pattern: {
          value: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
          message: 'Please enter a valid email',
        },
      },
    },
    {
      name: 'phone',
      placeholder: 'Phone Number',
      rules: {
        required: 'Phone number is required',
        pattern: {
          value: /^\d{10}$/,
          message: 'Please enter a valid 10-digit phone number',
        },
      },
    },
    {
      name: 'password',
      placeholder: 'Password',
      rules: {required: 'Password is required'},
      secureTextEntry: true,
    },
    {
      name: 'confirmPassword',
      placeholder: 'Confirm Password',
      rules: {
        required: 'Please confirm your password',
        validate: (val: string) =>
          watch('password') === val || 'Passwords do not match',
      },
      secureTextEntry: true,
    },
  ];

  return (
    <BackgroundWrapper>
      <AuthHeader title="Register" />
      <Text style={styles.title as TextStyle}>
        Join, Plan, Prosper – Register to Take Charge of Your Finances!
      </Text>
      <ScrollView contentContainerStyle={styles.scrollContent}>
        <View style={styles.loginField}>
          {formFields.map(field => (
            <Controller
              key={field.name}
              control={control}
              name={field.name}
              rules={field.rules}
              render={({field: {onChange, value}}) => (
                <Input
                  value={value}
                  onChangeText={onChange}
                  placeholder={field.placeholder}
                  error={errors[field.name]?.message}
                  secureTextEntry={field.secureTextEntry}
                />
              )}
            />
          ))}

          <ButtonIconComponent
            marginTop={20}
            title="Register"
            onPress={handleSubmit(onSubmit)}
          />
          <View style={styles.forgotPassword}>
            <TouchableOpacity
              activeOpacity={0.5}
              onPress={() => navigation.replace('SignIn')}>
              <Text style={styles.forgetText as TextStyle}>
                Already have account?
              </Text>
            </TouchableOpacity>
          </View>
        </View>
      </ScrollView>
    </BackgroundWrapper>
  );
};

export default SignUp;
