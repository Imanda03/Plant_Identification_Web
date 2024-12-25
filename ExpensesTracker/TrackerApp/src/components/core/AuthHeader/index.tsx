import {View, Text, TouchableOpacity} from 'react-native';
import {createStyles} from './styles';
import {EntypoIcon, IoniconsIcon} from '../../../utils/Icon';
import {useTheme} from '../../../utils/colors';
import {useNavigation} from '@react-navigation/native';

interface AuthHeaderProps {
  title: string;
}

const AuthHeader = ({title}: AuthHeaderProps) => {
  const styles = createStyles();
  const {theme} = useTheme();
  const navigation = useNavigation();
  return (
    <View style={styles.container}>
      <TouchableOpacity onPress={() => navigation.goBack()}>
        <IoniconsIcon name="arrow-back" color={theme.TEXT} size={30} />
      </TouchableOpacity>
      <Text style={styles.title}>{title}</Text>
      <View></View>
    </View>
  );
};

export default AuthHeader;
